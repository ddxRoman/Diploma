<? session_start();
$val=$_SESSION['text'];
$full = $_SESSION['textfull'];
$count=$_SESSION['txt'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    textarea{
        width: 100%;
        height: 250px;
        font-size: 14pt;
    }
    .checkcount{
        border-radius: 6px;
        background-color: midnightblue;
        color: beige;
        font-weight: 800;
    }
</style>
<body>
    <form action="../action/countSymb.php" method="post">
        <textarea name="text"><?=$val?></textarea><br>
        <button class="checkcount">Посчитать</button>
    </form><br>
    <form action="../action/textGenerator.php" method="post">
        <!-- <input type="number" name="col" placeholder="кол-во слов"> -->
    <button>Сгенерировать текст</button>
    </form>
    <h3>Количество символов всего: <?=$full?></h3>
    <h2>Количество символов без пробелов: <?=$count?></h2>
</body>
</html>