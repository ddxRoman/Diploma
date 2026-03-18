<?php
ob_clean(); // Убираем лишний вывод, если что-то было до этого

// Настройки подключения (не забудь поменять на MySQL-8.4 если работаешь в OS6)
$connect = mysqli_connect('localhost', 'user','qazwsx','diploma');
// $connect = mysqli_connect('MySQL-8.4', 'root','','diploma');

if (!$connect) {
    die(json_encode(['error' => 'Ошибка подключения']));
}

if (!isset($_POST['street']) || trim($_POST['street']) === '') {
    echo json_encode([]);
    exit;
}

$street = mysqli_real_escape_string($connect, $_POST['street']);

// Получаем дома этой улицы — только активные (disable = 0)
$query = mysqli_query(
    $connect,
    "
    SELECT `build`
    FROM `ventra_home`
    WHERE `street` = '$street' AND `disable` = 0
    ORDER BY 
      CAST(`build` AS UNSIGNED) ASC,  -- Сначала числовая сортировка
      `build` ASC                     -- Затем текстовая (1А, 1Б)
    "
);

$builds = [];
if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $builds[] = $row['build'];
    }
}

// Отправляем JSON ответ
header('Content-Type: application/json; charset=utf-8');
echo json_encode($builds, JSON_UNESCAPED_UNICODE);