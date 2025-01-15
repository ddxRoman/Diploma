<?php
session_start();
require_once '../../../action/connect.php'; 

$category1='Продукты';
$yearget=$_GET['year'];
if($yearget==""){
    $session['year']=date('Y');
}else {$session['year']=$yearget; }?><br><?
$monthget=$_GET['month'];
$today=date('d');
$current_month=date('m');
$select_year = $session['year'];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/finance/finance-style.css">
    <title><?=$category1?></title>
</head>
<body>
              <ul class="month_ul_reports">

<? 

        foreach ($finance_total as $finance_total) { 
            ?>
    <a onchange="this.form.submit()" href="Food_reports.php?month=<?=$monthget?>&year=<?=$finance_total[0]?>"><li><?=$finance_total[0];?></li></a>
               <?
           }
        ?>
        </ul>
    <a href="../../finance.php">
        <h1><?=$category1?></h1>


    </a>
    <div class="month_line">
        <ul class="month_ul_reports">
        <?

        foreach($month_list as $month_lists) { 
            $key = array_search ($month_lists, $month_list);
if (($monthget==$key) || (date('m')==$key && $i==0 && $monthget<date('m'))){ 
    $i=1;
    ?>
    <a class="current_month_reports" onchange="this.form.submit()" href="Food_reports.php?month=<?=$key?>&year=<?=$select_year?>"><li><?=$month_lists?></li></a> <?
    }else{ 
    ?><a onchange="this.form.submit()" href="Food_reports.php?month=<?=$key?>&year=<?=$select_year?>"><li><?=$month_lists?></li></a><?
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
                        <tr>
                            <th></th>
                            <th></th>
                            <th>       <h4 class="h4_reports"> <?=$select_year?></h4></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?
                        $total=0;
                        // echo $monthget.'---'.$select_year;
                        foreach ($filter as $filters) {
                            if ($monthget == ""){
                                list($year, $month, $day) = explode('-', $filters[1]); // Если формат "день-месяц-год" 
                            if (($month == date('m') && $year == $select_year) && ($filters[2]==$category1)) {
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
                            }

                        }
                        else {
                                list($year, $month, $day) = explode('-', $filters[1]); // Если формат "день-месяц-год" 
                            if (($month == $monthget && $year == $select_year) && ($filters[2]==$category1)) {
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
                        }
                    }
}                       if($monthget != "" && $monthget != $current_month ){ $avrg_coast=$total/$last_day; 
    // echo "IF".$monthget."--".$last_day;
}
else {$avrg_coast=$total/$today; 
    // echo "ELSE".$monthget."--".$current_month."--".$today;
}
                      ?> 
                      
                      <tfoot class="footer_total_line_table">
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table" title="В Среднем в день - <?=number_format((float)$avrg_coast, 2, '.', '')?>">
                                    <a href="#modal">
                                    <button type="button" class="total_smoke" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <?=$total?>
</button>  <br>
                                    </a>
                                </p>
                                <p class="avrg_table">
                                    <?=number_format((float)$avrg_coast, 2, '.', '')?>
                                </p>
                            </td>
                        </tr>
  </tfoot>
                    </table>  




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
<h3><?=$select_year?></h3>

           <ul><?
      foreach($month_list as $month_lists) { 
        $key = array_search ($month_lists, $month_list);
        ?><li>
<?
                     $total_smoke_month = 0;
                    foreach ($filter as $filters) {
                        list($year, $month, $day) = explode('-', $filters[1]); // Если формат "день-месяц-год" 
                        if($key==$month && $year==$select_year && $filters[2]==$category1){
                            $total_smoke_month=$total_smoke_month+$filters[4];
                        }
                    }
                    $total_year=$total_year + $total_smoke_month;
            echo $month_lists." - ".$total_smoke_month;
  ?>      </li>
        <?}
echo "Всего за год: ".$total_year." руб.";
        ?>

</ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Окей</button>
      </div>
    </div>
  </div>
</div>           
</body>
</html>