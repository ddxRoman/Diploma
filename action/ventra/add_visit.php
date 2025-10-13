<?php
require_once '../connect.php';

$visit_date = trim($_POST['visit_date']);
$adress_id = intval($_GET['id']);

// Проверяем, заполнены ли все данные
if (empty($visit_date) || empty($adress_id)) {
    die('<div style="
        font-family: system-ui;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f7f8fa;
        color: #333;
        font-size: 1.2rem;
    ">Ошибка: не переданы необходимые данные.</div>');
}

/* --- Находим адрес по ID --- */
$addr_stmt = $connect->prepare("SELECT `street`, `build` FROM `ventra_home` WHERE `id` = ?");
$addr_stmt->bind_param("i", $adress_id);
$addr_stmt->execute();
$addr_result = $addr_stmt->get_result();

if ($addr_result->num_rows === 0) {
    die('<div style="
        font-family: system-ui;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f8d7da;
        color: #721c24;
        font-size: 1.2rem;
        text-align:center;
    ">Ошибка: адрес с таким ID не найден.</div>');
}

$addr = $addr_result->fetch_assoc();
$street = htmlspecialchars($addr['street']);
$build = htmlspecialchars($addr['build']);
$addr_stmt->close();

/* --- Проверяем, есть ли уже такая запись --- */
$check = $connect->prepare("SELECT COUNT(*) FROM `visit_home_date` WHERE `adress_id` = ? AND `visit_date` = ?");
$check->bind_param("is", $adress_id, $visit_date);
$check->execute();
$check->bind_result($count);
$check->fetch();
$check->close();

if ($count > 0) {
    // Если запись уже существует
    echo '
    <div style="
        font-family: system-ui;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f0f2f5;
        color: #222;
        text-align: center;
    ">
    
        <h2 style="color:#d9534f;">⚠️ Запись уже существует</h2>
        <p>Для дома <b>' . $street . ' ' . $build . '</b> уже добавлена дата визита <b>' . htmlspecialchars($visit_date) . '</b>.</p>

        <a href="../../folders/ventra/current_home.php?street=' . urlencode($street) . '&build='.urlencode($build). '" 
           style="margin-top:20px; text-decoration:none; background:#007bff; color:white; padding:10px 20px; border-radius:8px;">
           ⬅ Вернуться назад
        </a>
    </div>';
    exit;
}

/* --- Если записи нет — добавляем новую --- */
$stmt = $connect->prepare("INSERT INTO `visit_home_date` (`adress_id`, `visit_date`) VALUES (?, ?)");
$stmt->bind_param("is", $adress_id, $visit_date);
$stmt->execute();
$stmt->close();

/* --- Вывод подтверждения --- */
echo '
<div style="
    font-family: system-ui;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #e8f5e9;
    color: #155724;
    text-align: center;
">
    <h2 style="color:#28a745;">✅ Дата добавлена успешно</h2>
    <p>Для дома <b>' . $street . ' ' . $build . '</b> добавлена дата визита: <b>' . htmlspecialchars($visit_date) . '</b>.</p>
    <meta http-equiv="refresh" content="3;url=../../folders/ventra/current_home.php?street=' . urlencode($street) . '&build='.urlencode($build). '">
    <a href="../../folders/ventra/current_home.php?street=' . urlencode($street) . '&build='.urlencode($build). '" 
       style="margin-top:20px; text-decoration:none; background:#28a745; color:white; padding:10px 20px; border-radius:8px;">
       ⬅ Вернуться
    </a>
</div>';
exit;
?>
