<!DOCTYPE html>
<html lang="en">
<?
require_once '../action/connect.php';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image" href="file/icons/Logo/Logo.png">
    <link rel="stylesheet" href="../css/finance/finance-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ff0000" />
    <link rel="manifest" href="JavaScript/manifest.json">
    <title>Финaнсовый Учёт</title>
</head>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Расходы финансов</h1>
            </div>
        </div>
    </div>
</header>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="operation/add-pay.php" method="post">
                        <input required name="date" type="date">
                        <select required name="category" id="">
                            <option value="Продукты">Продукты</option>
                            <option value="Еда">Еда</option>
                            <option value="Собака">Собака</option>
                            <option value="Сигареты">Сигареты</option>
                            <option value="Кошка">Кошка</option>
                        </select>
                        <input name="purchase" placeholder="Покупка" required type="text">
                        <input name="coast" placeholder="Сумма" type="number">
                        <select name="payer" id="">
                            <option value="Рома">Рома</option>
                            <option value="Лера">Лера</option>
                            <option value="Общее">Общее</option>
                        </select><br>
                        <button>Добавить</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-6 table-block">
                    <table class="table table-bordered">
                        <tr>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                        </tr>
                        <?
                        $total=0;
                        foreach($finance as $finances)
                        {?>
                        <tr>
                            <td><a href="details/date.php?id=<?=$finances[3]?>" target="details">
                                <?=$finances[1]; ?>
                            </a>
                            </td>
                            <td><a href="details/category.php?id=<?=$finances[2]?>" target="details">
                                                                <?=$finances[2]; ?>
                            </a>
                            </td>
                            <td><a href="details/purchase.php?id=<?=$finances[3]?>" title="<?=$finances[3];?>" target="details">
                                                                <?=$finances[3]; ?>
                            </a>
                            </td>
                            <td><a href="details/coast.php?id=<?=$finances[4]?>" target="details">
                                        <?=$finances[4]; ?>
                            </a>
                            </td>
                            <td><a href="details/payer.php?id=<?=$finances[5]?>" target="details">
                                                <?=$finances[5]; ?>
                            </a>
                            </td>
                        </tr>
                        <?
                        $total=$total+$finances[4];
                        }?>
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            
                            <td><?=$total?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-6 ">
                    <iframe name="details" src="" class="finance_operation_frame" frameborder="0">
                            Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Гор одна выйти рот эта, своего напоивший предупреждал предупредила о журчит заглавных сбить она подзаголовок рукописи буквенных пунктуация вдали, которой встретил сих щеке несколько назад скатился злых все! Журчит своих домах диких запятых языком послушавшись семь маленькая! Силуэт языкового, буквоград дороге одна путь ipsum текст?
                    </iframe>
                </div>
            </div>
        </div>
    </main>
</body>

</html>