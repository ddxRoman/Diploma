<?
require_once '../action/connect.php';
require_once "../function/checkaut.php";
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
<body>
    <!--    Надо это все в таблицу сделать -->
    <!-- Сделать проверку, какая почта на такую кнопка из МИС и кидает -->
    <form action="../action/CreateUser.php" method="POST" enctype="multipart/form-data">
    <table>

        <caption>Добавление пользователя</caption>

    <tr>
       <td><input required name="name" placeholder="Имя"></td> 
      <td><input required name="surname" placeholder="Фамилия"></td>  
      <td><input required name="patronymic" placeholder="Отчество"></td>    
    </tr>
    
    <tr>
        <td><input  name="telephone" type="tel" placeholder="Телефон">  </td>   
    <td><input required name="mail" type="email" placeholder="Почта"></td>    
    <td><input required name="password" type="password" placeholder="Пароль"></td>    
</tr>
<tr></tr>
    <td> <input  name="post" placeholder="Должность"></td>  
    <td> <input name="department" placeholder="Отдел"><br></td>   
</tr>
<tr><td><input name="telegram"  placeholder="Telegram"></td> 
    <td><input  name="viber" placeholder="Viber"></td> 
<td><input name="whatsapp" placeholder="What'sUp"></td> </tr>
<tr>
    <td><label>Фото сотрудника</label><input nmae="photo" type="file"></td>
</tr>
<tr><td><button>Создать</button></td> 
<td><input type="reset"></td> 
</tr>

        </table>
    </Form>


</body>
</html>