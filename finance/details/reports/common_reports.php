<?php
require_once '../../../action/connect.php'; 
$category1='Продукты';
$category2='Общие расходы';
$category3='Развлечения';
$monthget=$_GET['month'];
$today=date('d');
$year = date('y');
$last = date('t-'.$monthget.'-Y', mktime(0, 0, 0, $monthget+1, -1, $year));
list($last_day) = explode('-', $last); // Если формат "день-месяц-год" 
$month_list = array(
    "1" => "Январь",
    "2" => "Февраль",
    "3" => "Март",
    "4" => "Апрель",
    "5" => "Май",
    "6" => "Июнь",
    "7" => "Июль",
    "8" => "Август",
    "9" => "Сентябрь",
    "10" => "Октябрь",
    "11" => "Ноябрь",
    "12" => "Декабрь",
);

$i=0;
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
    <div class="month_line">
        <ul class="month_ul_reports">
        <?

        foreach($month_list as $month_lists) { 
            $key = array_search ($month_lists, $month_list);
if (($monthget==$key) || (date('m')==$key && $i==0 && $monthget<date('m'))){ 
    $i=1;
    ?>
    <a class="current_month_reports" onchange="this.form.submit()" href="common_reports.php?month=<?=$key?>"><li><?=$month_lists?></li></a> <?
    }else{ 
    ?><a onchange="this.form.submit()" href="common_reports.php?month=<?=$key?>"><li><?=$month_lists?></li></a><?
}
            }?>
        </ul>

    </div>
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
                        $total = 0;
                        foreach ($filter as $filters) {
                            if ($monthget == ""){
                                list($year, $month, $day) = explode('-', $filters[1]); // Если формат "день-месяц-год" 
                            if (($month == date('m') && $year == date('Y')) && ($filters[2]==$category1 || $filters[2]==$category2)) {
                        ?>
                                <tr>
                                    <td><a href="../date.php?id=<?= $filters[1] ?>" target="details">
                                            <?= $filters[1]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../category.php?id=<?= $filters[2] ?>" target="details">
                                            <?= $filters[2]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../purchase.php?id=<?= $filters[3] ?>" title="<?= $filters[3]; ?>" target="details">
                                            <?= $filters[3]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../coast.php?id=<?= $filters[4] ?>" target="details">
                                            <?= $filters[4]; ?> руб.
                                        </a>
                                    </td>
                                    <td><a href="../payer.php?id=<?= $filters[5] ?>" target="details">
                                            <?= $filters[5]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../hashtag.php?id=<?= $filters[6] ?>" target="details">
                                            <?= $filters[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $filters[4];
                                if($filters[5]=="Рома") {$total_Roma=$total_Roma+$filters[4]; }
if($filters[5]=='Лера') {$total_Lera=$total_Lera+$filters[4]; }
if($filters[5]=='Общее') {$total_Common=$total_Common+$filters[4]; }
                            }

                        }
                        else {


                                list($year, $month, $day) = explode('-', $filters[1]); // Если формат "день-месяц-год" 
                            if (($month == $monthget && $year == date('Y')) && ($filters[2]==$category1 || $filters[2]==$category2)) {

                        ?>
                                <tr>

                                    <td><a href="../date.php?id=<?= $filters[1] ?>" target="details">
                                            <?= $filters[1]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../category.php?id=<?= $filters[2] ?>" target="details">
                                            <?= $filters[2]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../purchase.php?id=<?= $filters[3] ?>" title="<?= $filters[3]; ?>" target="details">
                                            <?= $filters[3]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../coast.php?id=<?= $filters[4] ?>" target="details">
                                            <?= $filters[4]; ?> руб.
                                        </a>
                                    </td>
                                    <td><a href="../payer.php?id=<?= $filters[5] ?>" target="details">
                                            <?= $filters[5]; ?>
                                        </a>
                                    </td>
                                    <td><a href="detai..ls/hashtag.php?id=<?= $filters[6] ?>" target="details">
                                            <?= $filters[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $filters[4];
                                if($filters[5]=="Рома") {$total_Roma=$total_Roma+$filters[4]; }
if($filters[5]=='Лера') {$total_Lera=$total_Lera+$filters[4]; }
if($filters[5]=='Общее') {$total_Common=$total_Common+$filters[4]; }
                            
                        }



                        

                    }

}                                           
if($monthget != "" && $monthget != $month ){ $avrg_coast=$total/$last_day; }
else {$avrg_coast=$total/$today;}

echo "<b>Рома</b> -".$total_Roma."<br> <b>Лера</b> - ".$total_Lera."<br> <b>Общее</b> - ".$total_Common;
                      ?> 
                      
                      <tfoot class="footer_total_line_table">
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table" title="В Среднем в день - <?=number_format((float)$avrg_coast, 2, '.', '')?>">
                                    <?=$total?> <br>
                                </p>
                                <p class="avrg_table">
                                    <?=number_format((float)$avrg_coast, 2, '.', '')?>
                                </p>
                            </td>
                        </tr>
  </tfoot>
                    </table>
</body>
</html>