<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Профиль</title>
</head>

<style>
    /* Основные сбросы и шрифты */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

body {
    background-color: #f4f6f9;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Контейнер карточки */
.user_card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    padding: 30px;
    max-width: 650px;
    width: 100%;
    margin: 0 auto;
}

/* Таблица внутри карточки */
.user_card_table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
}

/* Заголовок карточки */
.user_card_table thead {
    display: block;
    margin-bottom: 20px;
}

.user_card_table h2,
.user_card_table h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 10px;
    text-align: left;
}

/* Фото пользователя */
.user_card_photo {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #e2e8f0;
    transition: transform 0.2s ease, border-color 0.2s ease;
}

.user_card_photo:hover {
    transform: scale(1.03);
    border-color: #3b82f6;
}

/* Ячейки таблицы */
.user_card_table th,
.user_card_table td {
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    font-weight: 400;
    font-size: 15px;
    color: #475569;
}

/* Подписи к полям (класс .card) */
.card, 
font.card {
    display: block;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    font-weight: 600;
    margin-bottom: 4px;
}

/* Иконки мессенджеров */
.logo_messendger_user_card {
    width: 28px;
    height: 28px;
    margin-right: 10px;
    transition: opacity 0.2s ease, transform 0.2s ease;
    vertical-align: middle;
}

.logo_messendger_user_card:hover {
    opacity: 0.8;
    transform: translateY(-2px);
}

/* Стилизация кнопок действий */
.user_card button {
    background-color: #3b82f6;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
    margin-right: 10px;
    margin-top: 10px;
}

.user_card button:hover {
    background-color: #2563eb;
}

.user_card button:active {
    transform: scale(0.98);
}

/* Кнопка "Назад" (вторая по счету) */
.user_card a[href="../index.php"] button {
    background-color: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
}

.user_card a[href="../index.php"] button:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}

/* Адаптивность для мобильных устройств */
@media (max-width: 580px) {
    .user_card_table, 
    .user_card_table tbody, 
    .user_card_table tr, 
    .user_card_table th {
        display: block;
        width: 100%;
        text-align: center;
    }

    .user_card_table th {
        padding: 8px 0;
    }

    .user_card_photo {
        margin: 0 auto 15px auto;
    }

    .user_card button {
        width: 100%;
        margin-right: 0;
    }
}
</style>

<body>


<?php 

session_start();
$status = $_SESSION['user']['status'];
require_once '../action/connect.php';
require_once '../action/users/StyleAndSettings.php';
$mail=$_GET['mail']; 
if($status!=1936){
$admin = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `email`"); // Подключение к определенной таблице, и получение Статуса записи
$admin = mysqli_fetch_all($admin); // Выбирает все строки из набора $product и помещает их в массив  $product
foreach($admin as $admins){

    if($admins[3]==$mail){
        ?>
        <div class="user_card">
        <table class="user_card_table">
            <thead>    <h2 color="black">Карточка сотрудника</h2></thead>
            <tr>
            <th rowspan="2"><a href="<?= $admins[4]?>"><img src="<?=$admins[4]?>" class="user_card_photo"></a></th>
            <th><br><font class="card"><?= "Код сотрудника:<br>"?></font><?= $admins[0] ?></th>
            <th><font class="card"><?= "Должность:<br>"?></font><?=$admins[5]?></th>
            </tr>
            <tr>
            <th><font class="card"><?= "Логин : <br>"?></font><?= $admins[1]?></th>
            <th><font class="card"><?="Почта: <br>"?></font><?=$admins[3]?></th>
        </tr>
        </table>
   <?
                   $id_user = $admins[0];
$check_id = mysqli_query($connect, "SELECT * FROM `settings_users` WHERE `id_user` = '$id_user' ");
    if(mysqli_num_rows($check_id)<1)
    {
    echo "Добавлены персональные настройки юзера <br>";
    mysqli_query($connect, "INSERT INTO `settings_users` (`id`, `id_user`, `background`, `text_color`) VALUES (NULL, '$id_user', '000000', 'ffffff');");
}
?> <a href="../index.php"><button>Назад</button></a>
<a href="settings.php?mail=<?=$persons[5]?>"><button>Редактировать</button></a>

<?
}
}


}else{
$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `mail`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product
    foreach($person as $persons){

        if($persons[5]==$mail){
            ?>
            <div class="user_card">
            <table class="user_card_table">
                <thead>    <h3>Карточка сотрудника</h3></thead>
                <tr>
                <th rowspan="2"><a href="<?= $persons[12]?>"><img src="<?=$persons[12]?>" class="user_card_photo"></a></th>
                <th><br><?= $persons[2], " ",  $persons[1], " ", $persons[3] ?></th>
                <th><?= $persons[4]?></th>
                <th><?= $persons[5]?></th>
                </tr>
                <tr>
                <th><?= $persons[7]?></th>
                <th><?= $persons[8]?></th>
            </tr>
            <tr>
                <th>
                    <?
                     if($persons[9]!=Null){?>
                     <a href="<?= $persons[9]?>"><img src="../file/icons/telegram_logo.png" class="logo_messendger_user_card"></a><?
                    }if($persons[10]!=Null){?>
                    <a href="<?= $persons[10]?>"><img src="../file/icons/teams_logo.png" class="logo_messendger_user_card"></a>
                    <?}if($persons[11]!=Null){?>
                    <a href="<?= $persons[11]?>"><img src="../file/icons/zoom_logo.png" class="logo_messendger_user_card"></a>
                    <?}?>
                </th>
            </tr>
            </table>
       <?
                       $id_user = $persons[0];
    $check_id = mysqli_query($connect, "SELECT * FROM `settings_users` WHERE `id_user` = '$id_user' ");
        if(mysqli_num_rows($check_id)<1)
        {
        echo "Добавлены персональные настройки юзера <br>";
        mysqli_query($connect, "INSERT INTO `settings_users` (`id`, `id_user`, `background`, `text_color`) VALUES (NULL, '$id_user', '000000', 'ffffff');");
}
?> <a href="../index.php"><button>Назад</button></a>
<a href="users/settings.php?mail=<?=$persons[5]?>"><button>Редактировать</button></a>

 <?
}
}}
    ?>
      </div>      
</body>
</html>