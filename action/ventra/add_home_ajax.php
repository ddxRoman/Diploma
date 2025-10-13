<?php
require_once '../connect.php';
header('Content-Type: application/json; charset=utf-8');

$street = '';
if (!empty($_POST['street_select']) && $_POST['street_select'] !== '__new__') {
    $street = trim($_POST['street_select']);
} elseif (!empty($_POST['street'])) {
    $street = trim($_POST['street']);
}

$build = isset($_POST['build']) ? trim($_POST['build']) : '';

if (empty($street) || empty($build)) {
    echo json_encode(['status' => 'error', 'message' => 'Не все поля заполнены']);
    exit;
}

// Проверяем, есть ли уже такой дом
$stmt = $connect->prepare("SELECT COUNT(*) FROM ventra_home WHERE street = ? AND build = ?");
$stmt->bind_param("ss", $street, $build);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    echo json_encode(['status' => 'exists', 'message' => 'Такой дом уже есть']);
    exit;
}

// Добавляем новый дом
$stmt = $connect->prepare("INSERT INTO ventra_home (street, build) VALUES (?, ?)");
if ($stmt) {
    $stmt->bind_param("ss", $street, $build);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['status' => 'success', 'message' => 'Дом успешно добавлен']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка при добавлении']);
}
