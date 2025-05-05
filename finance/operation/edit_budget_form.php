<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="../../file/icons/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/finance/finance-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование взноса в бюджет</title>
</head>
<?
require_once '../../action/connect.php';
$id=$_GET['id'];
$operation=mysqli_query($connect, "SELECT*FROM `budget` WHERE `id`='$id'");
$operation=mysqli_fetch_assoc($operation);

?>
<body>
    <form action="edit_budget.php" method="post">
    <input  class="edit_page_form" type="hidden" name="id" value="<?=$operation['id']?>"><br>
        <input class="edit_page_form" type="date" name="date" placeholder="Дата" value="<?=$operation['date']?>"><br>
        <input class="edit_page_form" type="text" name="name" placeholder="Имя" value="<?=$operation['payer']?>"><br>
        <input class="edit_page_form" type="number" name="summa" placeholder="Сумма" value="<?=$operation['summ']?>"><br>
        <button>Сохранить</button>
    </form>

                    
</body>
</html>