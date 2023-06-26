<? require_once '../action/connect.php';
$topic = mysqli_query($connect, "SELECT * FROM `ttreeds` ORDER BY `id` ASC "); 
$topic = mysqli_fetch_all($topic); 
$answer = mysqli_query($connect, "SELECT * FROM `ttreeds_comments` ORDER BY `id` ASC "); 
$answer = mysqli_fetch_all($answer); 
?>
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

<?
                                                        foreach ($answer as $answers) { 
                                                            if ($answers[2] == $topic[0]) {
                                                                $owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$answers[1] ");
                                                                 $owner = mysqli_fetch_all($owner);
                                                                 foreach($owner as $owners){
                                                               ?>
                                <div class="wrapper-boxes">
                                <font class="owner-comment"> <? echo $owners[1]." ". $topic[3]; ?> </font>
                                         <div class="box"><p><font ><?=$answers[3]?></font><hr class="comment"></p></div>
                                </div>

                                
                            </a><?
                                                                 } 
                                                            }
                                                         } ?>


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