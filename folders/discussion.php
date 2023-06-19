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
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
<div class="box"><p><font >Автор от Дата</font><br>Lorem ipsum dolor sit </p></div>
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