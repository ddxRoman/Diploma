<?php
require_once '../connect.php';

$street = isset($_POST['street']) ? trim($_POST['street']) : '';
$build = isset($_POST['build']) ? trim($_POST['build']) : '';

$message = '';
$redirect_url = '../../folders/ventra/home.php';

// Проверяем наличие записи
if ($ventra == null) {
    mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`) VALUES (NULL, '$street', '$build')");
    $message = "Дом <b>" . htmlspecialchars($street) . " — " . htmlspecialchars($build) . "</b> добавлен!";
} else {
    $exists = false;
    foreach ($ventra as $ventras) {
        if ($ventras[1] == $street && $ventras[2] == $build) {
            $exists = true;
            $message = "Дом <b>" . htmlspecialchars($street) . " — " . htmlspecialchars($build) . "</b> уже есть в базе!";
            break;
        }
    }

    if (!$exists) {
        mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`) VALUES (NULL, '$street', '$build')");
        $message = "Дом <b>" . htmlspecialchars($street) . " — " . htmlspecialchars($build) . "</b> добавлен!";
    }
}

// Автоматический переход через 5 секунд
echo '<meta http-equiv="refresh" content="5;url=' . $redirect_url . '">';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Результат</title>
<style>
    body {
        background: #f7f8fa;
        font-family: "Segoe UI", Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .message-box {
        background: #fff;
        padding: 40px 60px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 500px;
        animation: fadeIn 0.5s ease-in-out;
    }
    .message-box h2 {
        color: #333;
        margin-bottom: 20px;
        font-size: 22px;
    }
    .message-box p {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }
    .message-box a button {
        background: #0078ff;
        color: #fff;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }
    .message-box a button:hover {
        background: #005fcc;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-10px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>
<body>
    <div class="message-box">
        <h2><?= $message ?></h2>
        <p>Вы будете перенаправлены через 5 секунд</p>
        <a href="<?= $redirect_url ?>"><button>Перейти сейчас</button></a>
    </div>
</body>
</html>
