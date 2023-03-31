<?
require_once '../action/connect.php';
require_once "../function/checkaut.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление пользователя</title>
</head>
<body>
    <h3 align="center">Добавление пользователя</h3>
    <!--    Надо это все в таблицу сделать --> 
    <Form>
        <input placeholder="Имя">
        <input placeholder="Фамилия">
        <input placeholder="Отчество">
        <input type="tel" placeholder="Телефон">  <br>
        <input type="email" placeholder="Почта">
        <input type="password" placeholder="Пароль"><br>
        <input placeholder="Должность">
        <input placeholder="Отдел"><br>
        <input type="url" placeholder="Telegram">
        <input type="url" placeholder="Viber">
        <input type="url" placeholder="What'sUp"><br>
        <button>Создать</button>
        <input type="reset">
    </Form>
    <button>Отменить</button>

</body>
</html>