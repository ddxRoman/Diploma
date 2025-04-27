<? require_once '../action/connect.php';
$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="../file/icons/Logo.png">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">   <!-- Надо переработать вот тут, почистить и сделать норм настройки -->
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Трекинг</title>
</head>
<body class="body_tracking">
    <header class="header_track">
    <a href="../index_admin.php" class="track_header">
        <h1>Трекинг</h1>
    </a>    
    </header>
    <main>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="../action/add_track.php" method="post">
                <input type="date" class="add_tracking" name="date" value="<?=$today?>">
                <input type="text" class="add_tracking" name="time" placeholder="Время">
                <input type="text" class="add_tracking" name="type" placeholder="Работа">
                <select class="add_tracking" name="project" id="">
                    <option value="Музыка">Музыка</option>
                    <option value="Колбико">Колбико</option>
                    <option value="Селлакшери">Селлакшери</option>
                    <option value="CSD">CSD</option>
                    <option value="Другие проекты">Другие проекты</option>
                </select>
                <button class=" add_tracking_btn">Добавить</button>
            </form>
            <hr class="footer-hr">

            <table class="table_track">
                <thead></thead>
                <th>Дата</th>
                <th>Время</th>
                <th>Тип работы</th>
                <th>Проект</th>
                
                <?
                $total=0;
                 foreach ($tracking as $trakings) {?>
                    <tr>
                        <td><?=$trakings[1]?></td>
                        <td><?=$trakings[2]?></td>
                        <td><?=$trakings[3]?></td>
                        <td><?=$trakings[4]?></td>
                    </tr>

                    <? $total = $total + $trakings[2];
                 }?>
                    <tfoot class="tfoot_track">
                        <tr>
                            <td>Итого:</td>
                            <td><strong><?=$total?></strong></td>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>
</div>
    </main>
    <footer>
    <hr class="footer-hr">
        <div class="footer">
            
                <div></div>
            
            <div class="refresh">
            <p class="ink"><br><img src="../file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-2023 </p>
            </div>
            <div id="clock" class="clock">         
            <script src="JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
        </div>
    </footer>
</body>
</html>