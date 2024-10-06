<?php
require_once '../../../action/connect.php'; 
$category='Продукты';
$date=$_POST['date'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/finance/finance-style.css">
</head>
<body class="reports_body">
<?
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
                        foreach($finance as $finances  ){
                            if($finances[2] == $category){
                        ?>
                        <tr>
                            <td>
                                <?=$finances[1]; ?>
                            </td>
                            <td>
                                                                <?=$finances[2]; ?>
                            </td>
                            <td>
                                                                <?=$finances[3]; ?>
                            </td>
                            <td>
                                        <?=$finances[4]; ?>
                            </td>
                            <td>
                                                <?=$finances[5]; ?>
                            </td>
                        </tr>
                        <?
                        $total=$total+$finances[4];
                        }
                        }?>
                      <tfoot class="footer_total_line_table">
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table">
                                    <?=$total?>
                                </p>
                            </td>
                        </tr>
  </tfoot>
                    </table>
</body>
</html>