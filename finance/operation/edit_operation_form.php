<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="../../file/icons/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/finance/finance-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?
require_once '../../action/connect.php';
$operation_id=$_GET['id'];
$operation=mysqli_query($connect, "SELECT*FROM `expenses` WHERE `id`='$operation_id'");
$operation=mysqli_fetch_assoc($operation);

?>
<body>
    <form action="edit_operation.php" method="post">
    <input  class="edit_page_form" type="hidden" name="id" value="<?=$operation['id']?>"><br>
    <input  class="edit_page_form" type="date" name="date" value="<?=$operation['date']?>"><br>
                        <select class="edit_page_form" required name="category" id="" value="<?=$operation['category']?>"><br>
                            <option value="<?=$operation['category']?>"><?=$operation['category']?></option>
                            <option value="Продукты">Продукты</option>
                            <option value="Общие расходы">Общие расходы</option>
                            <option value="Бытовые расходы">Бытовые расходы</option>
                            <option value="Собака">Собака</option>
                            <option value="Развлечения">Развлечения</option>
                            <option value="Сигареты">Сигареты</option>
                            <option value="Кошка">Кошка</option>
                            <option value="Личное">Личное</option>
                            <option value="Здоровье">Здоровье</option>
                            <option value="Кредитки">Кредитки</option>
                        </select><br>
                        <input class="edit_page_form" name="coast" placeholder="Сумма"  type="number" value="<?=$operation['coast']?>"><br>
                        <input class="edit_page_form" name="purchase" placeholder="Покупка" type="text" value="<?=$operation['purchase']?>"><br>
                        <select  class="edit_page_form" name="payer" id="" value="<?=$operation['payer']?>"><br>
                        <option value="<?=$operation['payer']?>"><?=$operation['payer']?></option>
                            <option value="Рома">Рома</option>
                            <option value="Лера">Лера</option>
                            <option value="Общее">Общее</option>
                        </select><br>
                        <? if ($operation['card']=='Shared'){?><input title="С совместного счёта" name="card" type="checkbox" checked> <?}
                        else {
                        ?>
                        <input class="edit_page_form" title="С совместного счёта" name="card" type="checkbox" >
                        <?}?>
                        <!-- <label for="card">Платёж был осуществлён с совместного счёта</label> -->
                        <br>
                        <input class="edit_page_form" name="hashtag" type="text" value="<?=$operation['hashtag']?>"> <label for="card"></label>
                        <br>
                        <button class="save_operation_button">Изменить</button>
                    </form>
                    <a href="delete_operation.php?id=<?=$operation_id?>">
                        <button class="delet_operation_button"> <img src="../../file/icons/delete_pay.svg" alt=""> Удалить</button>
                    </a>
                    
</body>
</html>