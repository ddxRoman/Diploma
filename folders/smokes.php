<?php

require_once '../action/connect.php'; // Проверка подключения к БД
$count_cigaret_date = mysqli_query($connect, "SELECT * FROM `smoke` ORDER BY `id` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$count_cigaret_date = mysqli_fetch_all($count_cigaret_date); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
$timeNow = date("H:i");
$date=Null;
$dateNow=date("d.m.Y");
?>

<style>
    .count-cigarets-total{
        padding-top: 5px;
        font-weight: 900;
        font-size: large;
    }
    .form{
        padding-top: 1%;
        position: fixed;
        top: 1%;
        width: 100%;
        background-color: grey;
    }
    .telo{
        position: relative;
        padding-top: 5%;
    }
    table{
    border: 2px solid #FF000F;
    min-width: 150px;
    }
    th{
    border: 2px solid #FF00FF;
    }
    td{
    border: 2px solid #00FFFF;
    }

    
    div.minimalistBlack {
  border: 3px solid #000000;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
.divTable.minimalistBlack .divTableCell, .divTable.minimalistBlack .divTableHead {
  border: 1px solid #000000;
  padding: 5px 4px;
}
.divTable.minimalistBlack .divTableBody .divTableCell {
  font-size: 13px;
}
.divTable.minimalistBlack .divTableHeading {
  background: #CFCFCF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 3px solid #000000;
}
.divTable.minimalistBlack .divTableHeading .divTableHead {
  font-size: 15px;
  font-weight: bold;
  color: #000000;
  text-align: left;
}
.minimalistBlack .tableFootStyle {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  border-top: 3px solid #000000;
}
.minimalistBlack .tableFootStyle {
  font-size: 14px;
}
/* HTMLtable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}

</style>

<header class="form">    
    <form action="../action/addcigarets.php" method="POST" enctype="multipart/form-data">
        <input type="number" name="count" placeholder="Количество сигарет">
        <input type="time" name="time" value="<?=$timeNow?>">
        <input type="date" name="day" value="<?=$dateNow?>"/>
        <button type="submit">Сигарета</button>
    </form>
</header>
<body class="telo">

<div class="divTable minimalistBlack">
  <div class="divTableHeading">
    <div class="divTableRow">
      <div class="divTableHead">Количество</div>
      <div class="divTableHead">Время</div>
      <div class="divTableHead">Интервал</div>

    </div>
  </div>


  
  <? foreach ($count_cigaret_date as $count_cigaret_dates) {
      $time1=$count_cigaret_dates[2];
      if($date!=$count_cigaret_dates[3]){
          $date=$count_cigaret_dates[3];?>
    <?
            $count_cigaret = mysqli_query($connect, "SELECT * FROM `smoke` WHERE `date`='$date' ORDER BY `id` ASC"); // Подключение к определенной таблице, и получение Статуса записи
            $count_cigaret = mysqli_fetch_all($count_cigaret); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
            foreach ($count_cigaret as $count_cigarets){
                if($count_cigarets[3]==$date){
                    $time2=$count_cigarets[2];
                    ?><div class="divTableCell"><?=$date?></div><?
                    ?>  
                    <div class="divTableBody">
                    <div class="divTableRow">

                      <div class="divTableCell"><?=$count_cigarets[1]?></div>
                      <div class="divTableCell"><?=$count_cigarets[2]?></div>
                      <?

                    // echo "<b>".$count_cigarets[1]."</b> сигареты в ".$count_cigarets[2];
                    $days_count_cigarets=$count_cigarets[1]+$days_count_cigarets;
                    $start_date = new DateTime($time1);
                    $since_start = $start_date->diff(new DateTime($time2));
                    ?><div class="divTableCell"><?echo $since_start->h.":".$since_start->i?></div>
                    </div>
                  </div><?
                    // echo "--",$since_start->h.':', $since_start->i.'<br>';
                }
                $time1=$time2;
            }


?>
  <div class="divTableFoot tableFootStyle">
      <div class="divTableRow">
          <div class="divTableCell"><?echo "Всего сирегат за день: ".$days_count_cigarets."<br>";?>
        </div>
    </div>
    </div>
</div><?
    $days_count_cigarets=0;
} else{ 
}
}






?>
</body>