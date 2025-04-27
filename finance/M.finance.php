<!DOCTYPE html>
<html lang="en">
<?
session_start();
require_once '../action/connect.php';

if($_SESSION['last_date']==""){
    $last_date=date("Y-m-d");

} else {$last_date=$_SESSION['last_date'];}
$i=0;
if($_SESSION['year']=="") $_SESSION['year']=date('Y');
if($_SESSION['month']=="") $_SESSION['month']=date('m');


$yearget=$_GET['year'];
$monthget=$_GET['month'];

if($yearget!=""){
    $_SESSION['year']=$yearget;
}  

if($monthget!=""){
    $_SESSION['month']=$monthget;
}  
            $select_month = $_SESSION['month'];
            $select_year = $_SESSION['year'];

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
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image" href="file/icons/Logo/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ff0000" />
    <link rel="manifest" href="JavaScript/manifest.json">
    <link rel="stylesheet" href="../css/finance/finance-style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <title>Финaнсовый Учёт</title>
</head>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
            <div class="row">
                <div class="col-2">
                <ul class="month_ul_reports">
                    <form  action="M.finance.php?month=<?=$select_month?>&year=<?=$finance_total[0]?>">
                    <select class="select_year" onchange="this.form.submit()" name="year" id="" placeholder="Выберите год">
                        <? if($yearget==''){?><option disabled selected value=""><?=$select_year?></option> <?}
                        else { ?> <option disabled selected value=""><?=$yearget?></option> <?}
        foreach ($finance_total as $finance_total) { 
            ?>

                    <option value="<?=$finance_total[0];?>"><?=$finance_total[0];?></option>
                    
                    <?
           }
           ?>
           </select>
        </form>
        <form  action="M.finance.php?month=<?=$key?>&year=<?=$select_year?>">
            
            
            <?
    ?><select onchange="this.form.submit()" name="month" id=""><?
foreach($month_list as $month_lists) {     // Список месяцов в линию---------------------------------------------------------------
    $key = array_search ($month_lists, $month_list);
    if (($select_month==$key) || (date('m')==$key && $i==0 && $select_month<date('m'))){ 
        $i=1;
        ?>
        <option value="<?=$key?>" selected>
            
            <?=$month_lists?> 
        </option>
        <?
    }else{ 
        ?>
    <option value="<?=$key?>">
        <?=$month_lists?> 
    </option>
    
    <?
}
}?>
</select>
        <!-- </ul> -->
        </form>
        </ul>
                </div>

            </div>
            </div>
            <div class="col-4 reports_link_block">
                <a href="operation/reports.php">
                    <button class="common-Filter_btn">Отчёты</button>
                </a>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="month_line">
        <!-- <ul class="month_ul_reports"> -->

    </div>
    <main>
        <div class="container-fluid body_finance">
            <div class="row">
                <div class="col-12">
                    <form action="operation/add-pay.php" method="post">
                        <input required name="date" type="date" value="<?= $last_date ?>" autofocus/>
                        <select required name="category" id="" >
                            <option value="Продукты">Продукты</option>
                            <option value="Общие расходы" title="Общие расходы - расходы которые касаются Праздников, прогулок, платежей, являются не регулярными и не стабильными">Общие расходы</option>
                            <option value="Бытовые расходы" title="Бытовые расходы - расходы которые касаются общих мероприятий и явялются ежемесячными или регулярными" >Бытовые расходы</option>
                            <option value="Сигареты">Сигареты</option>
                            <option value="Развлечения">Развлечения</option>
                            <option value="Личное">Личное</option>
                            <option value="Собака">Собака</option>
                            <option value="Кошка">Кошка</option>
                            <option value="Здоровье">Здоровье</option>
                            <option value="Кредитки">Кредитки</option>
                        </select><br>
                        <input name="coast" placeholder="Сумма" type="number">
                        <input name="purchase" placeholder="Покупка" type="text"><br>
                        <select name="payer" id="">
                            <?
                            
                            if($_SESSION['last_payer']!="") {?><option value="<?=$_SESSION['last_payer']?>"><?=$_SESSION['last_payer']?></option><?}
                            ?>
                            <option value="Рома">Рома</option>
                            <option value="Лера">Лера</option>
                            <option value="Общее">Общее</option>
                        </select>
                        <input name="hashtag" type="text" placeholder="Хештэг">
                        <br>
                        <button>Добавить</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-6 table-block">
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                            <!-- <th>Хештег</th> -->
                        </tr>
                        <?
                        $total = 0;
                        $credits = 0;
                        foreach ($finance as $finances) {
                                list($year, $month, $day) = explode('-', $finances[1]); // Если формат "день-месяц-год" 
                            if ($month == $select_month && $year == $select_year) {
                                if ($i<16){
                                $i++;
                        ?>
                                <tr>

                                    <td>
                                        <a href="operation/edit_operation_form.php?id=<?= $finances[0] ?>">
                                            <img src="../file/icons/edit_for_finance.svg" class="icon_edit_finance" alt="">
                                        </a>
                                    </td>
                                    <td><a href="details/date.php?id=<?= $finances[1] ?>" target="details">
                                            <?= $finances[1]; ?>
                                        </a>
                                    </td>
                                    <td><a href="details/category.php?id=<?= $finances[2] ?>" target="details">
                                            <?= $finances[2]; ?>
                                        </a>
                                    </td>
                                    <td><a href="details/purchase.php?id=<?= $finances[3] ?>" title="<?= $finances[3]; ?>" target="details">
                                            <?= $finances[3]; ?>
                                        </a>
                                    </td>
                                    <td><a href="details/coast.php?id=<?= $finances[4] ?>" target="details">
                                            <?= $finances[4]; ?> руб.
                                        </a>
                                    </td>
                                    <td><a href="details/payer.php?id=<?= $finances[5] ?>" target="details">
                                            <?= $finances[5]; ?>
                                        </a>
                                    </td>
                                    <!-- <td><a href="details/hashtag.php?id=<?= $finances[6] ?>" target="details">
                                            <?= $finances[6]; ?>
                                        </a>
                                    </td> -->
                                </tr>
                        <?}
                                $total = $total + $finances[4];
                                if($finances[2]=='Кредитки'){ $credits=$credits+$finances[4]; }
                            }
                        

                        }?>
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>

                            <td><?=$total?> руб.</td>
                        </tr>
                    </table>
                   <div class="m_total_coast">
                       <?= $total; if($credits>0){?>(<span title="<?=$total-$credits ?>"><?=$credits?></span>)<?}?>  руб.
                   </div>
                </div>

            </div>
        </div>
    </main>
</body>

<div style="display: none; width: 500px;" id="hidden">
</div>

</html>