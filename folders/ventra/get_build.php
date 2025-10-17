<?php
ob_clean(); // Убираем лишний вывод, если что-то было до этого

$connect = mysqli_connect('localhost', 'user','qazwsx','diploma');
// $connect = mysqli_connect('localhost', 'ddx','Beetle19','diploma');
if (!isset($_POST['street']) || trim($_POST['street']) === '') {
    echo json_encode([]);
    exit;
}

$street = mysqli_real_escape_string($connect, $_POST['street']);

// Получаем дома этой улицы — сортировка по возрастанию
$query = mysqli_query(
    $connect,
    "
    SELECT `build`
    FROM `ventra_home`
    WHERE `street` = '$street'
    ORDER BY 
      CAST(`build` AS UNSIGNED) ASC,  -- Сначала числовая сортировка (для домов 1, 2, 10 и т.д.)
      `build` ASC                     -- Затем текстовая, если номера содержат буквы (1А, 1Б)
    "
);

$builds = [];
while ($row = mysqli_fetch_assoc($query)) {
    $builds[] = $row['build'];
}

// Отправляем JSON ответ
header('Content-Type: application/json; charset=utf-8');
echo json_encode($builds, JSON_UNESCAPED_UNICODE);