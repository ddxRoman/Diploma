<?
session_start();
require_once '../action/connect.php';
$mail=$_GET['mail'];
$editPerson = mysqli_query($connect, "SELECT * FROM `users` WHERE `mail`='$mail'"); // Подключение к определенной таблице, и получение Статуса записи
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
    <div class="addUser">
    <div class="addUserCard">
    <table>
    <form action="../action/Second_editUser.php" method="POST" enctype="multipart/form-data">
        <caption>Редактирование пользователя</caption>
    <tr>
        <td><input   required name="surname" placeholder="Фамилия" value="<?=$editPerson['surname']?>"></td>  
        <td><input required name="name" placeholder="Имя" value="<?=$editPerson['name']?>"></td> 
        <td><input disabled  name="patronymic" placeholder="Отчество" value="<?=$editPerson['patronymic']?>"></td>    
    </tr>
    <tr>
        <td><input  name="telephone" type="tel" placeholder="Телефон" value="<?=$editPerson['telephone']?>">  </td>   
    <td><input required name="mail" type="email" placeholder="Почта" value="<?=$editPerson['mail']?>"></td>        
</tr>

<tr>
    <td> 
    <label>Отдел:<br></label>
    <select name="department">
        <option hidden>Отдел</option>
        <?$dep="Внедрение";
         if($dep==$editPerson['department']){?>
        <option name="" selected>Внедрение</option>
        <option name="">Продажи</option>
        <option name="">Бухгалтерия</option>
        <option name="">Руководители</option><?}?>
        <?$dep="Продажи";
         if($dep==$editPerson['department']){?>
        <option name="" >Внедрение</option>
        <option name="" selected>Продажи</option>
        <option name="">Бухгалтерия</option>
        <option name="">Руководители</option><?}?>
        <?$dep="Бухгалтерия";
         if($dep==$editPerson['department']){?>
        <option name="" >Внедрение</option>
        <option name="">Продажи</option>
        <option name="" selected>Бухгалтерия</option>
        <option name="">Руководители</option><?}?>
        <?$dep="Руководители";
         if($dep==$editPerson['department']){?>
        <option name="" >Внедрение</option>
        <option name="">Продажи</option>
        <option name="">Бухгалтерия</option>
        <option name="" selected>Руководители</option><?}else{?>
        <option name="" >Внедрение</option>
        <option name="">Продажи</option>
        <option name="">Бухгалтерия</option>
        <option name="" >Руководители</option>
        <?}?>
    </select>   
    </td>  
    <td>
    <label>Должность:<br></label>

    <select name="post">
    <?$post="Руководитель отдела";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option selected>Руководитель отдела</option>
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
         <?}?>
         <?$post="Интегратор";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option selected>Интегратор</option>
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
         <?}?>
         <?$post="Директор";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
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
        <option selected>Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Менеджер";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option selected>Менеджер</option>
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
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Менеджер внедрения";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option selected>Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option>Менеджер продаж</option>
        <option>Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option>Глвный бухгалтер</option>
        <option>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Менеджер продаж";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option selected>Менеджер продаж</option>
        <option>Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option>Глвный бухгалтер</option>
        <option>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Руководител отдела";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option selected>Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option>Глвный бухгалтер</option>
        <option>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Глвный бухгалтер";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option selected>Глвный бухгалтер</option>
        <option>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Старший бухгалтер";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option >Глвный бухгалтер</option>
        <option selected>Старший бухгалтер</option>
        <option>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Бухгалтер";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option >Глвный бухгалтер</option>
        <option >Старший бухгалтер</option>
        <option selected>Бухгалтер</option>
        <optgroup label = "Руководители">
        <option name="">СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="СЕО";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option >Глвный бухгалтер</option>
        <option >Старший бухгалтер</option>
        <option >Бухгалтер</option>
        <optgroup label = "Руководители">
        <option selected>СЕО</option>
        <option >Директор</option>
        <option name="">Комерческий директор</option>
         <?}?>
         <?$post="Комерческий директор";
         if($post==$editPerson['post']){?>
        <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option >Глвный бухгалтер</option>
        <option >Старший бухгалтер</option>
        <option >Бухгалтер</option>
        <optgroup label = "Руководители">
        <option >СЕО</option>
        <option >Директор</option>
        <option selected>Комерческий директор</option>
         <?}else{?>
            <option hidden>Должность</option>
        <optgroup label = "Внедрение">
        <option >Руководитель отдела</option>
        <option >Интегратор</option>
        <option >Менеджер</option>
        <option >Менеджер внедрения</option>
        <optgroup label = "Продажи">
        <option >Менеджер продаж</option>
        <option >Руководител отдела</option>
        <optgroup label = "Бухгалтерия">
        <option >Глвный бухгалтер</option>
        <option >Старший бухгалтер</option>
        <option >Бухгалтер</option>
        <optgroup label = "Руководители">
        <option >СЕО</option>
        <option >Директор</option>
        <option >Комерческий директор</option>
         <?}?>
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
</tr>
<tr>
    <td>    <input  name="newpassword" type="newPassword" placeholder="Новый Пароль" ></td>   
    <td>    <input  name="newpassword2" type="newPassword" placeholder="Потвердите пароль" ></td>   
    <td>    </td>  </tr> 
<tr><td><button class="create">Сохранить</button></td> 
<input hidden name="id" value="<?=$editPerson['id']?>">
</Form>
<td></td>
<td align="end"><a href="user_list.php"><button class="cancel">Отмена</button></a></td> 
</tr>
        
        </table>