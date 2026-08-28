<?php
require_once "../connect.php";
header('Content-Type: application/json; charset=utf-8');

$id = intval($_POST['id'] ?? 0);
if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Не указан ID']);
    exit;
}

$stmt = mysqli_prepare($connect, "SELECT `image` FROM `ventra_advert` WHERE `id` = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo json_encode(['status' => 'error', 'message' => 'Реклама не найдена']);
    exit;
}

$delStmt = mysqli_prepare($connect, "DELETE FROM `ventra_advert` WHERE `id` = ?");
mysqli_stmt_bind_param($delStmt, "i", $id);
$ok = mysqli_stmt_execute($delStmt);

if ($ok) {
    // Приводим сохранённый путь (в идеале "/file/ventra/advert/..",
    // но у старых записей мог остаться "../../file/ventra/advert/..")
    // к пути относительно этого файла (action/ventra/), т.е. "../../file/...".
    $stored = $row['image'];
    $relative = preg_replace('#^(\.\./)+#', '', $stored); // убрать возможные ../../
    $relative = ltrim($relative, '/');                    // убрать ведущий /
    $filePath = '../../' . $relative;

    if (is_file($filePath)) {
        @unlink($filePath);
    }
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка удаления из базы данных']);
}
