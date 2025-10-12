<?php
require_once '../connect.php';

// Если пользователь выбрал улицу из списка — она придёт в street_select
// Если ввёл вручную — в street
$street = '';
if (!empty($_POST['street'])) {
    $street = trim($_POST['street']); // Ввел новую улицу
} elseif (!empty($_POST['street_select']) && $_POST['street_select'] !== '__new__') {
    $street = trim($_POST['street_select']); // Выбрал существующую
}

$build = isset($_POST['build']) ? trim($_POST['build']) : '';

if (empty($street) || empty($build)) {
    die('<div style="
        font-family: system-ui;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f7f8fa;
        color: #333;
        font-size: 1.2rem;
    ">Ошибка: не все поля заполнены.</div>');
}

// Проверяем, существует ли уже такой дом
$stmt = $connect->prepare("SELECT COUNT(*) FROM `ventra_home` WHERE `street` = ? AND `build` = ?");
$stmt->bind_param("ss", $street, $build);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    // Если уже есть
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
        <h2 style="color:#d9534f;">⚠️ Такой дом уже существует</h2>
        <p><b>' . htmlspecialchars($street) . ', ' . htmlspecialchars($build) . '</b> уже есть в базе.</p>
        <a href="../../folders/ventra/home.php" 
           style="margin-top:20px; text-decoration:none; background:#007bff; color:white; padding:10px 20px; border-radius:8px;">
           Вернуться назад
        </a>
    </div>';
    exit;
}

// Добавляем новый дом
$stmt = $connect->prepare("INSERT INTO `ventra_home` (`street`, `build`) VALUES (?, ?)");
$stmt->bind_param("ss", $street, $build);
$stmt->execute();
$stmt->close();

// Возврат на список
header("Location: ../../folders/ventra/home.php");
exit;
?>
