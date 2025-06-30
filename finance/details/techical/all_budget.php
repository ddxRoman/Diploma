<?
require_once '../../../action/connect.php';
$total_V=0;
$total_R=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <link rel="stylesheet" href="../../../css/finance/finance-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пополнения бюджета</title>
</head>
<body>

    <table class="budget_table table">
        <tr>

            <th>Дата</th>
            <th>Имя</th>
            <th>Сумма</th>
            <th></th>
        </tr>
        <? foreach($budget as $budgets) {?>
        <tr>
            <td> <?=$budgets[1]?></td>
            <td> <?=$budgets[3]?></td>
            <td> <?=$budgets[2]?></td>
            <td> <a href="../../operation/edit_budget_form.php?id=<?=$budgets[0]?>"> <img class="icon_edit_finance" src="../../../file/icons/edit_for_finance.svg" alt=""> </a></td>
<? if($budgets[3]=='Лера') $total_V=$total_V+$budgets[2]; 
else if($budgets[3]=='Рома') $total_R=$total_R+$budgets[2];
?>
        </tr>
        <?}?>

    </table>

<h5>Лера: <?=$total_V?></h5>
<h5>Рома: <?=$total_R?></h5>

</body>
</html>