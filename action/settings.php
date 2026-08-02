<?
require_once "../action/connect.php";
session_start();

$status= $_SESSION['user']['status'];
if($status==9){
$role=1;
}
else {
    $role=2;
}

$type = $_SESSION['user']['status'];
$id_user=$_SESSION['user']['mail'];

if($type==1936){      
    $user=$_SESSION['user']['name'];
} else {
$user=$_SESSION['user']['login']; 
} 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Настройки профиля</title>
</head>

<style>
    /* Базовый сброс и центрирование */
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

/* Карточка формы */
.settings_card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    padding: 32px;
    max-width: 480px;
    width: 100%;
}

.settings_card h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 24px;
    padding-bottom: 12px;
    border-bottom: 2px solid #e2e8f0;
}

/* Группы полей ввода */
.form_group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 18px;
}

.form_group label {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Текстовые инпуты */
.settings_card input[type="text"] {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 15px;
    color: #1e293b;
    background-color: #f8fafc;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    outline: none;
}

.settings_card input[type="text"]:focus {
    border-color: #3b82f6;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}
.settings_card input[type="mail"] {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 15px;
    color: #1e293b;
    background-color: #f8fafc;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    outline: none;
}

.settings_card input[type="mail"]:focus {
    border-color: #3b82f6;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}

/* Инпут загрузки файла */
.settings_card input[type="file"] {
    font-size: 14px;
    color: #475569;
    padding: 8px;
    background-color: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 8px;
    cursor: pointer;
}

.settings_card input[type="file"]::-webkit-file-upload-button {
    background-color: #e2e8f0;
    color: #1e293b;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    margin-right: 10px;
    transition: background-color 0.2s ease;
}

.settings_card input[type="file"]::-webkit-file-upload-button:hover {
    background-color: #cbd5e1;
}

/* Блок кнопок */
.form_actions {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 24px;
}

.btn_save {
    background-color: #3b82f6;
    color: #ffffff;
    border: none;
    padding: 11px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn_save:hover {
    background-color: #2563eb;
}

.btn_save:active {
    transform: scale(0.98);
}

.btn_back {
    background-color: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.btn_back:hover {
    background-color: #e2e8f0;
    color: #1e293b;
}
</style>
<body>

<div class="settings_card">
    <h2>Настройки профиля</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form_group">
            <label for="username">Имя пользователя</label>
            <input type="text" id="username" name="username" value="<?=$user ?>" placeholder="Введите имя">
        </div>

        <div class="form_group">
            <label for="avatar">Аватар профиля</label>
            <input type="file" id="avatar" name="avatar" value="" accept="image/*">
        </div>

        <div class="form_group">
            <label for="additional_info">Почта</label>
            <input type="mail" id="mail" name="mail" value="" placeholder="Почта">
        </div>

        <div class="form_actions">
            <button type="submit" class="btn_save">Применить</button>
            <a href="../index.php" class="btn_back">Отмена</a>
        </div>
    </form>
</div>

</body>
</html>