<?php
require_once '../../action/connect.php';
$date=$_POST['date'];
$category=$_POST['category'];
$payer=$_POST['payer'];
$date=$_POST['date'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    
<?=$total?>
<? 
require_once '../../action/connect.php'; 
$filter_category = $_GET['id'];
$filter=mysqli_query($connect, "SELECT*FROM `expenses` WHERE `id`='$filter_category'");
$filter=mysqli_fetch_assoc($filter);
?> 
<table class="table table-hover">
                        <tr>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                        </tr>
                        <?
                        $total=0;
                        foreach($finance as $finances){
                            if($finances[5] == $payer && $finances[2] == $category && $finances[1] == $date){
                        ?>
                        <tr>
                            <td><a href="details/date.php" target="details">
                                <?=$finances[1]; ?>
                                </a>
                            </td>
                            <td><a href="details/category.php" target="details">
                                                                <?=$finances[2]; ?>
                            </a>
                            </td>
                            <td><a href="details/product.php" title="<?=$finances[3];?>" target="details">
                                                                <?=$finances[3]; ?>
                            </a>
                            </td>
                            <td><a href="details/price.php" target="details">
                                        <?=$finances[4]; ?>
                            </a>
                            </td>
                            <td><a href="details/payer.php" target="details">
                                                <?=$finances[5]; ?>
                            </a>
                            </td>
                        </tr>
                        <?
                        $total=$total+$finances[4];
                        }

                        }?>
                        <tr >
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table">
                                    <?=$total?>
                                </p>
                            </td>
                        </tr>
                    </table>
</body>
</html>