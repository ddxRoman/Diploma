<!DOCTYPE html>
<html lang="en">
<?
require_once '../action/connect.php';
$i=0;
$date_today = date("Y-m-d");
$monthget=$_GET['month'];
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
                <? $Roma_budget = 0;
                $Lera_budget = 0;
                foreach ($budget as $budgets) {

                    if ($budgets[3] == "Рома")     $Roma_budget = $Roma_budget + $budgets[2];
                    if ($budgets[3] == "Лера")     $Lera_budget = $Lera_budget + $budgets[2];
                }
                ?> Общак:
                <br> Рома - <?= $Roma_budget ?>
                <br> Лера - <?= $Lera_budget ?>
                <br><?
                    ?>
                <a data-fancybox href="#hidden"><button>Вкинуть</button></a>
            </div>
            <div class="col-3">
                <h1 class="text-center">Расходы финансов</h1>
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
        <ul class="month_ul">
        <?

        foreach($month_list as $month_lists) { 
            $key = array_search ($month_lists, $month_list);
if (($monthget==$key) || (date('m')==$key && $i==0 && $monthget<date('m'))){ 
    $i=1;
    ?>
    <a class="current_month" onchange="this.form.submit()" href="finance.php?month=<?=$key?>"><li><?=$month_lists?></li></a> <?
    }else{ 
    ?><a onchange="this.form.submit()" href="finance.php?month=<?=$key?>"><li><?=$month_lists?></li></a><?
}
            }?>
        </ul>

    </div>
    <main>
        <div class="container-fluid body_finance">
            <div class="row">
                <div class="col-12">
                    <form action="operation/add-pay.php" method="post">
                        <input required name="date" type="date" value="<?= $date_today ?>" autofocus/>
                        <select required name="category" id="">
                            <option value="Продукты">Продукты</option>
                            <option value="Общие расходы">Общие расходы</option>
                            <option value="Общие расходы">Бытовые расходы</option>
                            <option value="Собака">Собака</option>
                            <option value="Развлечения">Развлечения</option>
                            <option value="Сигареты">Сигареты</option>
                            <option value="Кошка">Кошка</option>
                            <option value="Личное">Личное</option>
                            <option value="Здоровье">Здоровье</option>
                        </select>
                        <input name="coast" placeholder="Сумма" type="number">
                        <input name="purchase" placeholder="Покупка" type="text">
                        <select name="payer" id="">
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
                            <th>Примечание</th>
                        </tr>
                        <?
                        $total = 0;
                        foreach ($finance as $finances) {
                            if ($monthget == ""){
                                list($year, $month, $day) = explode('-', $finances[1]); // Если формат "день-месяц-год" 
                            if ($month == date('m') && $year == date('Y')) {

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
                                    <td><a href="details/hashtag.php?id=<?= $finances[6] ?>" target="details">
                                            <?= $finances[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $finances[4];
                            }
                        }
                        else {


                                list($year, $month, $day) = explode('-', $finances[1]); // Если формат "день-месяц-год" 
                            if ($month == $monthget && $year == date('Y')) {

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
                                    <td><a href="details/hashtag.php?id=<?= $finances[6] ?>" target="details">
                                            <?= $finances[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $finances[4];
                            
                        }



                        }
                        }?>
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>

                            <td><?= $total ?> руб.</td>
                        </tr>
                    </table>
                   <div class="total_coast">
                       <?= $total ?> руб.
                   </div>
                </div>
                <div class="col-6 ">
                    <iframe name="details" src="details\short_reports.php" class="finance_operation_frame" frameborder="0">
                    </iframe>
                </div>
            </div>
        </div>
    </main>
</body>

<div style="display: none; width: 500px;" id="hidden">
    <form action="operation/budget.php" method="post">
        <input name="date_pay" type="date">
        <input name="summa" type="number">
        <select name="contributor" id="">
            <option value="Рома">Рома</option>
            <option value="Лера">Лера</option>
        </select>
        <Button>Вкинуть лавеху</Button>
    </form>
</div>

</html>