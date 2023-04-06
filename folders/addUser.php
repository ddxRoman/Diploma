<?
require_once '../action/connect.php';
require_once "../function/checkaut.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление пользователя</title>
</head>
<style>

</style>
<body>
    <!--    Надо это все в таблицу сделать -->
    <!-- Сделать проверку, какая почта на такую кнопка из МИС и кидает -->
    <div class="addUser">
    <div class="addUserCard">
    <form action="../action/CreateUser.php" method="POST" enctype="multipart/form-data">
    <table>
        <caption>Добавление пользователя</caption>
    <tr>
       <td><input required name="name" placeholder="Имя"></td> 
      <td><input required name="surname" placeholder="Фамилия"></td>  
      <td><input  name="patronymic" placeholder="Отчество"></td>    
    </tr>
    <tr>
        <td><input  name="telephone" type="tel" placeholder="Телефон">  </td>   
    <td><input required name="mail" type="email" placeholder="Почта"></td>    
    <td><input required name="password" type="password" placeholder="Пароль"></td>    
</tr>

<tr>
    <td> 
    <label>Отдел:<br></label>
    <select>
        <option hidden>Отдел</option>
        <option name="">Внедрение</option>
        <option>Продажи</option>
        <option>Бухгалтерия</option>
        <option name="">Руководители</option>
    </select>   
    </td>  
    <td>
    <label>Должность:<br></label>
    <select>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option name="">Руководитель отдела</option>
        <option>Интегратор</option>
        <option>Менеджер</option>
        <option>Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option>Менеджер продаж</option>
        <option>Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option>Глвный бухгалтер</option>
        <option>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option name="">Директор</option>
        <option name="">Комерческий директор</option>
    </select>  
    </td>  
    <td> 
        
</td>   
</tr>
<tr>
    <td><input name="telegram"  placeholder="Telegram"></td> 
    <td><input  name="zoom" placeholder="Zoom"></td> 
<td><input name="teams" placeholder="Teams"></td> 
</tr>
<tr>
    <td><label>Фото сотрудника</label><input name="photo" type="file"></td>
</tr>
<tr><td><button>Создать</button></td> 
<td><input type="reset"></td> 
</tr>

        </table>
    </Form>
    <div class="message">
<p class="sms"> <?echo $_SESSION['sms']; ?> </p> 
</div>
 <?
unset($_SESSION['sms']);
?> 
</div>
</div>
</body>
</html>