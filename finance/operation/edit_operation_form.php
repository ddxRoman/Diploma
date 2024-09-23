<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <input type="hidden" name="id" value="<?=$operation['id']?>">
    <input type="date" name="date" value="<?=$operation['date']?>">
                        <select required name="category" id="" value="<?=$operation['category']?>">
                            <option value="<?=$operation['category']?>"><?=$operation['category']?></option>
                            <option value="Продукты">Продукты</option>
                            <option value="Общие расходы">Общие расходы</option>
                            <option value="Собака">Собака</option>
                            <option value="Развлечения">Развлечения</option>
                            <option value="Сигареты">Сигареты</option>
                            <option value="Кошка">Кошка</option>
                            <option value="Личное">Личное</option>
                            <option value="Здоровье">Здоровье</option>
                        </select>
                        <input name="coast" placeholder="Сумма"  type="number" value="<?=$operation['coast']?>">
                        <input name="purchase" placeholder="Покупка" required type="text" value="<?=$operation['purchase']?>">
                        <select name="payer" id="" value="<?=$operation['payer']?>">
                        <option value="<?=$operation['payer']?>"><?=$operation['payer']?></option>
                            <option value="Рома">Рома</option>
                            <option value="Лера">Лера</option>
                            <option value="Общее">Общее</option>
                        </select>
                        <button>Изменить</button>
                    </form>
                    <a href="delete_operation.php?id=<?=$operation_id?>">
                        <button>Удалить</button>
                    </a>
                    
</body>
</html>