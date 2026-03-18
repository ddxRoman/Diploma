<?php
require_once "../connect.php";
header('Content-Type: application/json');

$type = $_POST['type'] ?? '';
$id = intval($_POST['id'] ?? 0);
$newName = trim($_POST['newName'] ?? '');
// Получаем статус переключателя (0 или 1)
$disable = isset($_POST['disable']) ? intval($_POST['disable']) : 0;

if (!$newName && $type !== 'home') {
    echo json_encode(['status' => 'error', 'message' => 'Недостаточно данных']);
    exit;
}

if ($type === 'street') {
    $oldStreet = $_POST['oldName'] ?? '';
    // При переименовании улицы меняем её название у всех домов на этой улице
    $query = "UPDATE ventra_home SET street = ? WHERE street = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "ss", $newName, $oldStreet);
    
} elseif ($type === 'home') {
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Нет ID дома']);
        exit;
    }
    // Обновляем и номер дома (build), и статус активности (disable)
    $query = "UPDATE ventra_home SET build = ?, disable = ? WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "sii", $newName, $disable, $id);
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Неверный тип']);
    exit;
}

if ($stmt) {
    $ok = mysqli_stmt_execute($stmt);
    echo json_encode(['status' => $ok ? 'ok' : 'error']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка подготовки запроса']);
}