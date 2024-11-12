<?php
require_once '../../../action/connect.php'; 
$category1='Продукты';
$category3='Общие расходы';
$category4='Развлечения';
$interval = $_POST['interval'];
$now_data = date("m");
echo "Tut - ". $now_data;
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
<table class="table table-hover">
                        <tr>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                            <th>Хештэг</th>
                        </tr>
                        <?
                        
                        $total=0;
                        foreach($finance as $finances  ){
                            if($finances[2] == $category1 ||  $finances[2] == $category3 || $finances[2] == $category4) 
                            if ($finances[7]== $now_data){
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
                        $total=$total+$finances[4] ;
                            }
} 


                      ?> 
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