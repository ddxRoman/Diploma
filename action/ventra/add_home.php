<?php
require_once '../connect.php';

// Говорим браузеру, что мы возвращаем JSON
header('Content-Type: application/json; charset=utf-8');

$street = trim($_POST['street'] ?? '');
$build = trim($_POST['build'] ?? '');

if ($street === '' || $build === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Не указана улица или дом"
    ]);
    exit;
}

// Проверяем, есть ли уже такой дом
$stmt = $connect->prepare("SELECT id FROM ventra_home WHERE street = ? AND build = ?");
$stmt->bind_param("ss", $street, $build);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "exists"]);
    exit;
}

// Добавляем новый дом
$stmt = $connect->prepare("INSERT INTO ventra_home (street, build) VALUES (?, ?)");
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

echo json_encode(["status" => "ok"]);
exit;
?>
