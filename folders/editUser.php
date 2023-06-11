<?
session_start();
require_once '../action/connect.php';
require_once '../action/users/StyleAndSettings.php';
require_once "../function/checkaut.php";

$mail=$_GET['mail'];
$editPerson = mysqli_query($connect, "SELECT * FROM `personal` WHERE `mail`='$mail'"); // Подключение к определенной таблице, и получение Статуса записи
$editPerson = mysqli_fetch_assoc($editPerson); // Выбирает все строки из набора $product и помещает их в массив  $product

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
</head>

<body>
    <!--    Надо это все в таблицу сделать -->
    <!-- Сделать проверку, какая почта на такую кнопка из МИС и кидает -->

    <div class="addUser">
    <div class="addUserCard">
    <table>
    <form action="../action/Second_editUser.php" method="POST" enctype="multipart/form-data">
        <caption>Редактирование пользователя</caption>
    <tr>
        <td><input required name="surname" placeholder="Фамилия" value="<?=$editPerson['surname']?>"></td>  
        <td><input required name="name" placeholder="Имя" value="<?=$editPerson['name']?>"></td> 
        <td><input  name="patronymic" placeholder="Отчество" value="<?=$editPerson['patronymic']?>"></td>    
    </tr>
    <tr>
        <td><input  name="telephone" type="tel" placeholder="Телефон" value="<?=$editPerson['telephone']?>">  </td>   
    <td><input required name="mail" type="email" placeholder="Почта" value="<?=$editPerson['mail']?>"></td>    

    
</tr>

<tr>
    <td> 
    <label>Отдел:<br></label>
    <select name="department" value="<?=$editPerson['post']?>">
        <option hidden>Отдел</option>
        <option name="">Внедрение</option>
        <option>Продажи</option>
        <option>Бухгалтерия</option>
        <option name="">Руководители</option>
    </select>   
    </td>  
    <td>
    <label>Должность:<br></label>
    <select name="post" value="<?=$editPerson['post']?>">
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
    <td><input name="telegram"  placeholder="Telegram" value="<?=$editPerson['telegram']?>"></td> 
    <td><input  name="zoom" placeholder="Zoom" value="<?=$editPerson['zoom']?>"></td> 
<td><input name="teams" placeholder="Teams" value="<?=$editPerson['teams']?>"></td> 
</tr>

    <td>
    <label  class="input-file">
	   	<input  type="file" name="photo">        
 	   	<span  class="input-file-btn">Загрузить фото</span>
 	</label>

    <!-- <label>Фото сотрудника</label><input class="download_photo" name="photo" type="file"></td> -->
</tr>
<tr>
    <td>    <input required name="password" type="newPassword" placeholder="Новый Пароль" ></td>   

    <td>    <input required name="password" type="newPassword" placeholder="Потвердите пароль" ></td>   
    <td>    <input required name="password" type="newPassword" placeholder="Ваш текущий пароль" ></td>  </tr> 
<tr><td><button class="create">Сохранить</button></td> 
</Form>
<td></td>
<td align="end"><a href="user_list.php"><button class="cancel">Отмена</button></a></td> 
</tr>

        </table>
        
    

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
<?php 

    mysqli_query($connect, "INSERT INTO `settings_user` (`id`, `id_user`)
    VALUES (NULL, `$id')
    ");
?>