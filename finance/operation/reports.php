<?
require_once '../../action/connect.php';
$date_today = date("m");
$category_array=[];
$purchase_array=[];
$hashtag_array=[];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/finance/finance-style.css">
    <title>Document</title>
</head>

<body>
    <a class="header_btn" href="../finance.php">
        <h1>Отчёты</h1>
    </a>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-3">
<h2>Отчёты</h2>
                <ul class="report_list">
                    <a href="../details/reports/Food_reports.php" title="Все расходы на продукты">
                        <li>Расходы на продукты</li>
                    </a>

                    <a href="../details/reports/common_reports.php" title="Все расходы на бытовую химию, подарки, развлечения, проезды и так далее, все кроме продуктов и прочие общие расходы">
                        <li>Расходы на общее дело</li>
                    </a>
                    <a href="../details/reports/pet_reports.php" title="Все расходы на животных">
                        <li>Животные</li>
                    </a>
                    <a href="../details/reports/smoke_reports.php" title="Все расходы на животных">
                        <li>Сигареты</li>
                    </a>
                    <a href="../details/reports/private_reports.php" title="Все личные расходы">
                        <li>Личное</li>
                    </a>
                    <a href="../details/reports/credits.php" title="Кредитки">
                        <li>Кредитки</li>
                    </a>
                    <a href="../details/reports/desc_order_reports.php" title="Все расходы от большего к меньшему">
                        <li>По убыванию</li>
                    </a>
                </ul>

            </div>
            <div class="col-3">
                <h2>По категориям</h2>
                <ul>
                    <?


$finance_report = mysqli_query($connect, "SELECT DISTINCT category FROM expenses"); // Подключение к определенной таблице, и получение Статуса записи
$finance_report = mysqli_fetch_all($finance_report); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

?>
   <ul>
       <?
  foreach ($finance_report as $finance_reports) { 
    $total_category=0;
    $count=0;
    foreach($finance as $finances){
        if($finance_reports[0]==$finances[2]){ $total_category=$total_category+$finances[4]; 
}}
$category_array[$finance_reports[0]] = $total_category;
}
arsort($category_array);
foreach($category_array as $paramName => $paramValue)
    echo "<li>".$paramName ." - ".$paramValue. " руб. </li>";
echo "<br><h4>".(count($category_array)."</h4>");

?>
</ul>
                 </ul>
            </div>
            <div class="col-3">
                <h2>По транзакциям</h2>
                <ul>
                <?


$finance_report = mysqli_query($connect, "SELECT DISTINCT purchase FROM expenses"); // Подключение к определенной таблице, и получение Статуса записи
$finance_report = mysqli_fetch_all($finance_report); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

?>
   <ul>
       <?
  foreach ($finance_report as $finance_reports) { 
    $total_category=0;
foreach($finance as $finances){
    if($finance_reports[0]==$finances[3])        $total_category=$total_category+$finances[4];}
    $purchase_array[$finance_reports[0]] = $total_category;
    }
    arsort($purchase_array);
    foreach($purchase_array as $paramName => $paramValue)
 echo "<li>".$paramName ." - ".$paramValue. " руб. </li>";
 echo "<br><h4>".(count($purchase_array)."</h4>");

?>
</ul>
                </ul>
            </div>
            <div class="col-3">
                <h2>По хештегам</h2>
                <ul>
                <?


$finance_report = mysqli_query($connect, "SELECT DISTINCT hashtag FROM expenses"); // Подключение к определенной таблице, и получение Статуса записи
$finance_report = mysqli_fetch_all($finance_report); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

?>
   <ul>
       <?
  foreach ($finance_report as $finance_reports) { 
    $total_category=0;
foreach($finance as $finances){
    if($finance_reports[0]==$finances[6])        $total_category=$total_category+$finances[4];}
    $hashtag_array[$finance_reports[0]] = $total_category;
    }
    arsort($hashtag_array);
    foreach($hashtag_array as $paramName => $paramValue)
    if($paramName!=""){
 echo "<li>".$paramName ." - ".$paramValue. " руб. </li>";}

 echo "<br><h4>".(count($hashtag_array)."</h4>");

?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>