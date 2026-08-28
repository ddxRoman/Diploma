<?php
require_once "../connect.php";
header('Content-Type: application/json; charset=utf-8');

$adressId = intval($_POST['adress_id'] ?? 0);
$advertId = intval($_POST['advert_id'] ?? 0);

if (!$adressId || !$advertId) {
    echo json_encode(['status' => 'error', 'message' => 'Не указаны обязательные параметры']);
    exit;
}

$checkHome = mysqli_prepare($connect, "SELECT `id` FROM `ventra_home` WHERE `id` = ?");
mysqli_stmt_bind_param($checkHome, "i", $adressId);
mysqli_stmt_execute($checkHome);
if (!mysqli_stmt_get_result($checkHome)->fetch_assoc()) {
    echo json_encode(['status' => 'error', 'message' => 'Дом не найден']);
    exit;
}

$checkAdvert = mysqli_prepare($connect, "SELECT `id`, `image` FROM `ventra_advert` WHERE `id` = ?");
mysqli_stmt_bind_param($checkAdvert, "i", $advertId);
mysqli_stmt_execute($checkAdvert);
$advertRow = mysqli_stmt_get_result($checkAdvert)->fetch_assoc();
if (!$advertRow) {
    echo json_encode(['status' => 'error', 'message' => 'Реклама не найдена']);
    exit;
}

$stmt = mysqli_prepare(
    $connect,
    "INSERT INTO `ventra_home_advert` (`adress_id`, `advert_id`) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE `advert_id` = VALUES(`advert_id`), `updated_at` = CURRENT_TIMESTAMP"
);
mysqli_stmt_bind_param($stmt, "ii", $adressId, $advertId);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'ok', 'image' => $advertRow['image']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка записи в базу данных']);
}
