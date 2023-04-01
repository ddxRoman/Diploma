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
    <form>
    <table>

        <caption>Добавление пользователя</caption>

    <tr>
       <td><input placeholder="Имя"></td> 
      <td><input placeholder="Фамилия"></td>  
      <td><input placeholder="Отчество"></td>    
    </tr>
    
    <tr>
        <td><input type="tel" placeholder="Телефон">  </td>   
    <td><input type="email" placeholder="Почта"></td>    
    <td><input type="password" placeholder="Пароль"></td>    
</tr>
<tr></tr>
    <td> <input placeholder="Должность"></td>  
    <td> <input placeholder="Отдел"><br></td>   
</tr>
<tr><td><input type="url" placeholder="Telegram"></td> 
    <td><input type="url" placeholder="Viber"></td> 
<td><input type="url" placeholder="What'sUp"></td> </tr>
<tr><td><button>Создать</button></td> 
<td><input type="reset"></td> 
</tr>

        </table>
    </Form>


</body>
</html>