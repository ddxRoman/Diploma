<?php
require_once "../connect.php";
header("Content-Type: application/json; charset=utf-8");

$type = $_POST['type'] ?? '';

if ($type === 'street') {
    $street = mysqli_real_escape_string($connect, $_POST['street'] ?? '');
    if (!$street) {
        echo json_encode(['status' => 'error', 'message' => 'Не указана улица']);
        exit;
    }
    $delete = mysqli_query($connect, "DELETE FROM ventra_home WHERE street='$street'");
    echo json_encode(['status' => $delete ? 'ok' : 'error']);
    exit;
}

if ($type === 'home') {
    $id = intval($_POST['id'] ?? 0);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Не указан ID']);
        exit;
    }
    $delete = mysqli_query($connect, "DELETE FROM ventra_home WHERE id=$id");
    echo json_encode(['status' => $delete ? 'ok' : 'error']);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Неверный тип операции']);
