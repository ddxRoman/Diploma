<?php
require_once '../../../action/connect.php'; 
$category1='Продукты';
$category2='Кошка';
$category3='Общие расходы';
$category4='Развлечения';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/finance/finance-style.css">
</head>
<body>
    <a href="../../finance.php">
        <h1>Общие расходы на благое дело</h1>
    </a>

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
                        $total_Roma=0;
                        $total_Lera=0;
                        $total_Common=0;
                        foreach($filter as $filters){
                            list($year, $month, $day) = explode('-', $filters[1]); 
                            if($month == date('m') && $year == date('Y')){
                            if($filters[2] == $category1 || $filters[2] == $category2 || $filters[2] == $category3 || $filters[2] == $category4) {
                        ?>
                        <tr>
                            <td>
                                <?=$filters[1]; ?>

                            </td>
                            <td>
                                                                <?=$filters[2]; ?>

                            </td>
                            <td>
                                                                <?=$filters[3]; ?>

                            </td>
                            <td>
                                        <?=$filters[4]; ?>

                            </td>
                            <td>
                                                <?=$filters[5]; ?>

                            </td>
                        </tr>
                        <? 
                        $total=$total+$filters[4];
 
if($filters[5]=="Рома") {$total_Roma=$total_Roma+$filters[4]; }
if($filters[5]=='Лера') {$total_Lera=$total_Lera+$filters[4]; }
if($filters[5]=='Общее') {$total_Common=$total_Common+$filters[4]; }
}                            }
}
echo "<b>Рома</b> -".$total_Roma."<br> <b>Лера</b> - ".$total_Lera."<br> <b>Общее</b> - ".$total_Common;
                      ?> 
                      
                      <tfoot class="footer_total_line_table">
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table">
                                    <?=$total?> Руб
                                </p>
                            </td>
                        </tr>
  </tfoot>
                    </table>
</body>
</html>