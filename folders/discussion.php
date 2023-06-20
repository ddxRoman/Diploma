<? require_once '../action/connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/news.css">
    <title>Document</title>
</head>

<body>
    <div class="allbody">
    <?php

$topic = mysqli_query($connect, "SELECT * FROM `thems` ORDER BY `id` ASC "); // Подключение к определенной таблице, и получение Статуса записи
$topic = mysqli_fetch_all($topic); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments



foreach($topic as $topic){

    ?>
    <h3><?=$topic[1]?></h3>
    <hr class="body">
    <p class="body_topic"><?=$topic[2]?></p>
<hr class="body">
<?
$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$topic[4] ");
$owner = mysqli_fetch_all($owner);
  foreach($owner as $owners){
?><p class="footer_epic"><?=$topic[3]." От: ".$owners[1]?></p>
<?
}
}
?><hr>

<div class="add_comments">
    <form action="../action/users/comentsTopic.php" method="post"> 
            <textarea name="comments"></textarea><br><br>
            <button class="addcom">Добавить</button>
    </form>
</div>


<div class="wrapper-boxes">
<div class="box"><p><font ><b>Роман 20.06.23</b></font><hr class="comment"><br> Всем спасибо</p></div>
<div class="box"><p><font ><b>Игорь 20.06.23</b></font><hr class="comment"><br>Все отлично. И документы под рукой, и телемост, и календарь и погода</p></div>
<div class="box"><p><font ><b>Коля 16.06.23</b></font><hr class="comment"><br>Хотелось бы свой собственный мессенджер, что бы не переходить в телеграмм каждый раз </p></div>
<div class="box"><p><font ><b>Игорь 16.06.23</b></font><hr class="comment"><br>Можно самому добавлять кнопки, взрослый конструктор </p></div>
<div class="box"><p><font ><b>Виталий Станиславович 16.06.23</b></font><hr class="comment"><br>Поменяйте мне фотку </p></div>
<div class="box"><p><font ><b>Виктор 16.06.23</b></font><hr class="comment"><br>Норм </p></div>
<div class="box"><p><font ><b>Сергей 16.06.23</b></font><hr class="comment"><br> -Приходится работать </p></div>
<div class="box"><p><font ><b>Саша 15.06.23</b></font><hr class="comment"><br>+ Быстрый доступ ко всему необходимому </p></div>
<div class="box"><p><font ><b>Женя 15.06.23</b></font><hr class="comment"><br>Удобно что есть все кнопки под рукой </p></div>
<div class="box"><p><font ><b>Павел 15.06.23</b></font><hr class="comment"><br>Нравится что можно самому выбирать себе оформление, тему, цвета </p></div>

</div>
<button id="button">Show 10</button>

</div>
</body>
</html>

<script> window.onload = function () {
        var box=document.getElementsByClassName('box');
        var btn=document.getElementById('button');
        for (let i=5;i<box.length;i++) {
            box[i].style.display = "none";
        }

        var countD = 5;
        btn.addEventListener("click", function() {
            var box=document.getElementsByClassName('box');
            countD += 5;
            if (countD <= box.length){
                for(let i=0;i<countD;i++){
                    box[i].style.display = "block";
                }
            }

        })
    }</script>