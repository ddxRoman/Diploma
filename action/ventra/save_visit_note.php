<style>
    /* === Базовые стили === */
body, html {
    margin: 0;
    padding: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

/* === Блок: page === */
.page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

/* Модификаторы состояния страницы */
.page--success {
    background-color: #e8f5e9;
    color: #155724;
}

.page--update {
    background-color: #eaf3ff;
    color: #004085;
}

.page--error {
    background-color: #fff0f0;
    color: #c00;
}

/* === Блок: result === */
.result {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

/* Элемент: карточка результата */
.result__card {
    background: #ffffff;
    border-radius: 16px;
    padding: 25px 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    max-width: 400px;
    width: 100%;
}

/* Элементы внутри карточки */
.result__title {
    font-size: 1.4rem;
    margin-bottom: 12px;
}

.result__info {
    font-size: 1rem;
    color: #333;
    margin-bottom: 20px;
    line-height: 1.4;
}

.result__button {
    display: inline-block;
    text-decoration: none;
    background-color: #007bff;
    color: white;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 1rem;
    transition: background 0.2s, transform 0.2s;
}

.result__button:hover {
    background-color: #0069d9;
    transform: translateY(-1px);
}

.page--success .result__button {
    background-color: #28a745;
}
.page--success .result__button:hover {
    background-color: #218838;
}

.result__note {
    font-size: 0.9rem;
    margin-top: 10px;
    color: #555;
}

/* === Адаптация под мобильные устройства === */
@media (max-width: 480px) {
    .result__card {
        padding: 20px 15px;
        border-radius: 12px;
    }

    .result__title {
        font-size: 1.2rem;
    }

    .result__button {
        width: 100%;
        font-size: 1rem;
        padding: 14px 0;
    }
}

</style>

<?php
require_once '../connect.php';

$adress_id = intval($_POST['adress_id']);
$visit_date = trim($_POST['visit_date']);
$dorhenders = isset($_POST['dorhenders']) ? 1 : 0;
$listovki = isset($_POST['listovki']) ? 1 : 0;
$pochtovye_yashiki = isset($_POST['pochtovye_yashiki']) ? 1 : 0;
$comment = trim($_POST['comment'] ?? '');

// Проверка обязательных данных
if (empty($adress_id) || empty($visit_date)) {
    die('<div class="result result--error">
            <p class="result__text">❌ Ошибка: не переданы необходимые данные.</p>
        </div>');
}

/* --- Проверка, есть ли запись --- */
$check_stmt = $connect->prepare("SELECT COUNT(*) FROM `visit_home_date` WHERE `adress_id` = ? AND `visit_date` = ?");
$check_stmt->bind_param("is", $adress_id, $visit_date);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

/* --- Добавление или обновление --- */
if ($count == 0) {
    $insert = $connect->prepare("
        INSERT INTO `visit_home_date`
        (`adress_id`, `visit_date`, `dorhenders`, `listovki`, `pochtovye_yashiki`, `comment`)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $insert->bind_param("isiiis", $adress_id, $visit_date, $dorhenders, $listovki, $pochtovye_yashiki, $comment);
    $insert->execute();
    $insert->close();

    $msg = "✅ Данные успешно добавлены";
    $status = "success";
} else {
    $update = $connect->prepare("
        UPDATE `visit_home_date`
        SET `dorhenders` = ?, `listovki` = ?, `pochtovye_yashiki` = ?, `comment` = ?
        WHERE `adress_id` = ? AND `visit_date` = ?
    ");
    $update->bind_param("iiisis", $dorhenders, $listovki, $pochtovye_yashiki, $comment, $adress_id, $visit_date);
    $update->execute();
    $update->close();

    $msg = "💾 Данные успешно обновлены";
    $status = "update";
}

/* --- Получаем адрес --- */
$addr_stmt = $connect->prepare("SELECT `street`, `build` FROM `ventra_home` WHERE `id` = ?");
$addr_stmt->bind_param("i", $adress_id);
$addr_stmt->execute();
$addr_stmt->bind_result($street, $build);
$addr_stmt->fetch();
$addr_stmt->close();

if (empty($street)) $street = '';
if (empty($build)) $build = '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сохранение данных</title>
    <link rel="stylesheet" href="save_checklist.css">
</head>
<body class="page page--<?= htmlspecialchars($status) ?>">
    <div class="result result--<?= htmlspecialchars($status) ?>">
        <div class="result__card">
            <h2 class="result__title"><?= htmlspecialchars($msg) ?></h2>
            <p class="result__info">
                Для дома <b><?= htmlspecialchars($street) ?> <?= htmlspecialchars($build) ?></b><br>
                Дата визита: <b><?= htmlspecialchars($visit_date) ?></b>
            </p>
            <!-- <a href="../../folders/ventra/current_home.php?street=<?= urlencode($street) ?>&build=<?= urlencode($build) ?>"  -->
            <a href="../../folders/ventra/home.php" 
               class="result__button">
               ⬅ Вернуться
            </a>
            <!-- <meta http-equiv="refresh" content="3;url=../../folders/ventra/current_home.php?street=<?= urlencode($street) ?>&build=<?= urlencode($build) ?>"> -->
            <meta http-equiv="refresh" content="3;url=../../folders/ventra/home.php">
             
            <p class="result__note">Автоматический возврат через 3 секунды...</p>
        </div>
    </div>
</body>
</html>
