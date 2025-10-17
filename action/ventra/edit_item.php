<?php
require_once "../connect.php";
header('Content-Type: application/json');

$type = $_POST['type'] ?? '';
$id = intval($_POST['id'] ?? 0);
$newName = trim($_POST['newName'] ?? '');

if (!$newName) {
  echo json_encode(['status' => 'error', 'message' => 'Недостаточно данных']);
  exit;
}

if ($type === 'street') {
  $oldStreet = $_POST['oldName'] ?? ''; // можно добавить старое название
  $query = "UPDATE ventra_home SET street = ? WHERE street = ?";
  $stmt = mysqli_prepare($connect, $query);
  mysqli_stmt_bind_param($stmt, "ss", $newName, $oldStreet);
} elseif ($type === 'home') {
  if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Нет ID дома']);
    exit;
  }
  $query = "UPDATE ventra_home SET build = ? WHERE id = ?";
  $stmt = mysqli_prepare($connect, $query);
  mysqli_stmt_bind_param($stmt, "si", $newName, $id);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Неверный тип']);
  exit;
}

$ok = mysqli_stmt_execute($stmt);
echo json_encode(['status' => $ok ? 'ok' : 'error']);
