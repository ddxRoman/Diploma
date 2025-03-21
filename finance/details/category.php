<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/finance/finance-style.css">
    <link rel="stylesheet" href="../../css/finance/finance-style.css">

</head>
<body>
    
<?
session_start();
require_once '../../action/connect.php';
$select_month = $_SESSION['month'];
$select_year = $_SESSION['year'];
$filter_category = $_GET['id'];
$filter=mysqli_query($connect, "SELECT*FROM `expenses` WHERE `id`='$filter_category'");
$filter=mysqli_fetch_assoc($filter);
$total=0;
?>
<a href="short_reports.php"><h1><? echo $filter_category?> </h1></a>
<table class="table table-hover">
                        <tr>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                        </tr>
                        <?
                        foreach($finance as $finances){
                            list($year, $month, $day) = explode('-', $finances[1]); // Если формат "день-месяц-год" 
                            if($month == $select_month && $year == $select_year && $finances[2] == $filter_category){
                        ?>
                        <tr>
                        <td>
                                        <a href="../operation/edit_operation_form.php?id=<?=$finances[0]?>">
                                            <img src="../../file/icons/edit_for_finance.svg" class="icon_edit_finance" alt="">
                                        </a>
                                    </td>
                            <td><a href="date.php?id=<?=$finances[1]?>" target="details">
                                <?=$finances[1];  ?>
                                </a>
                            </td>
                            <td><a href="category.php?id=<?=$finances[2]?>" target="details">
                                                                <?=$finances[2]; ?>
                            </a>
                            </td>
                            <td><a href="purchase.php?id=<?=$finances[3]?>" title="<?=$finances[3];?>" target="details">
                                                                <?=$finances[3]; ?>
                            </a>
                            </td>
                            <td><a href="coast.php?id=<?=$finances[4]?>" target="details">
                                        <?=$finances[4]; ?>
                            </a>
                            </td>
                            <td><a href="payer.php?id=<?=$finances[5]?>" target="details">
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