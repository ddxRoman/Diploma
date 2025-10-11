<?php
require_once "../../action/connect.php";
if(!$GET){
$street = $_POST['street'];
$build = $_POST['build'];
}
$street = $_GET['street'];
$build = $_GET['build'];

$sql = "SELECT id FROM ventra_home WHERE street = ? AND build = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$adress_id=$row['id'];


$ventra_builds_comment = mysqli_query($connect, "SELECT * FROM `ventra_builds_comment` WHERE `adress_id`= '$adress_id' ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra_builds_comment = mysqli_fetch_all($ventra_builds_comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
    <title><?=$street?> # <?=$build?></title>
</head>
<body class="">
<div class="all_page_ventra">

<header>
    <a href="home.php">
        <button class="btn_add_comments">На главную</button>
    </a>
    <h2><?=$street?> # <?=$build?></h2>
</header>

    <label for="btn_add_comments">Добавить комментарий</label>

        <form class="ventra" method="post" action="../../action/ventra/add_comments.php?street=<?=$street?>&build=<?=$build?>">
            <textarea required name="comment"></textarea><br>
            <button class="btn_add_comments" type="submit">Добавить</button>
</form>
<div>
<hr>
    <div >
        <?foreach($ventra_builds_comment as $ventra_builds_comments){
            ?>
            <div class="comments_block">
            <p><?=$ventra_builds_comments[3]?></p><?
            ?><p><?=$ventra_builds_comments[1]?></p>
            </div><?
        }
        ?>
        <p></p>
    </div>
</div>
</div>
</body>
</html>