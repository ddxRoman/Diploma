<?php
require_once "../connect.php";
header('Content-Type: application/json; charset=utf-8');

if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'Файл не получен']);
    exit;
}

$allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['photo']['tmp_name']);
finfo_close($finfo);

if (!in_array($mime, $allowed, true)) {
    echo json_encode(['status' => 'error', 'message' => 'Разрешены только изображения (JPG, PNG, WEBP, GIF)']);
    exit;
}

$maxSize = 10 * 1024 * 1024; // 10 МБ
if ($_FILES['photo']['size'] > $maxSize) {
    echo json_encode(['status' => 'error', 'message' => 'Файл слишком большой (максимум 10 МБ)']);
    exit;
}

// Необязательные даты размещения. Пустая строка -> NULL.
function normalize_date($value)
{
    $value = trim((string)$value);
    if ($value === '') {
        return null;
    }
    $d = DateTime::createFromFormat('Y-m-d', $value);
    if (!$d || $d->format('Y-m-d') !== $value) {
        return null;
    }
    return $value;
}

$startDate = normalize_date($_POST['start_date'] ?? '');
$endDate = normalize_date($_POST['end_date'] ?? '');

$ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
$ext = preg_replace('/[^a-z0-9]/', '', $ext);
if ($ext === '') {
    $ext = 'jpg';
}

// ВАЖНО: папка и имя файла намеренно НЕ содержат слово "advert" — иначе
// рекламные блокировщики (AdBlock/uBlock/AdGuard) прячут такие картинки
// и блокируют запросы к ним по URL-паттерну.
$dirOnDisk = '../../file/ventra/gallery/';
if (!is_dir($dirOnDisk)) {
    mkdir($dirOnDisk, 0755, true);
}

$filename = 'photo_' . time() . '_' . random_int(1000, 9999) . '.' . $ext;
$destination = $dirOnDisk . $filename;

// Путь от корня сайта — так картинка отображается одинаково независимо
// от того, с какой страницы (и с какой глубины вложенности) её выводят.
$dbPath = '/file/ventra/gallery/' . $filename;

if (!move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
    echo json_encode(['status' => 'error', 'message' => 'Не удалось сохранить файл на сервере']);
    exit;
}

$stmt = mysqli_prepare($connect, "INSERT INTO `ventra_advert` (`image`, `start_date`, `end_date`) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $dbPath, $startDate, $endDate);

if (mysqli_stmt_execute($stmt)) {
    $newId = mysqli_insert_id($connect);

    // Реклама сменяется: как только загружена новая, предыдущая
    // становится неактуальной — закрываем все ранее "открытые"
    // объявления (без даты окончания) сегодняшним днём.
    $today = date('Y-m-d');
    $closeStmt = mysqli_prepare(
        $connect,
        "UPDATE `ventra_advert` SET `end_date` = ? WHERE `id` != ? AND `end_date` IS NULL"
    );
    mysqli_stmt_bind_param($closeStmt, "si", $today, $newId);
    mysqli_stmt_execute($closeStmt);

    echo json_encode([
        'status' => 'ok',
        'id' => $newId,
        'image' => $dbPath,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка записи в базу данных']);
}
