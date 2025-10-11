<?php
ob_clean(); // Убираем лишний вывод, если что-то было до этого



$connect = mysqli_connect('localhost', 'user', 'qazwsx', 'diploma');
if (!$connect) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}

$ventra_street = mysqli_query($connect, "SELECT street, build FROM `ventra_home` ORDER BY `street` ASC");
$ventra_street = mysqli_fetch_all($ventra_street, MYSQLI_ASSOC);

$street = isset($_POST['street']) ? trim($_POST['street']) : '';

header('Content-Type: application/json; charset=utf-8');

if ($street === '') {
    echo json_encode([]);
    exit;
}

$builds = [];
foreach ($ventra_street as $row) {
    if ($row['street'] === $street) {
        $builds[] = $row['build'];
    }
}

echo json_encode(array_values(array_unique($builds)));
exit;
