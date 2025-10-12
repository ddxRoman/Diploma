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

$ventra_note_current = mysqli_query($connect, "SELECT * FROM `ventra_home_notefication` WHERE `adress_id`=$adress_id "); // Подключение к определенной таблице, и получение Статуса записи
$ventra_note_current = mysqli_fetch_all($ventra_note_current); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$ventra_builds_comment = mysqli_query($connect, "SELECT * FROM `ventra_builds_comment` WHERE `adress_id`=$adress_id ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra_builds_comment = mysqli_fetch_all($ventra_builds_comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
    <title><?=$street?> №<?=$build?></title>
</head>
<body class="">
<div class="all_page_ventra">

<header>
    <a href="home.php">
        <button class="btn_add_comments">На главную</button>
    </a>

    <?

$check = 0;
foreach ($ventra_note as $ventra_notes){
        if($ventra_notes[1] == $adress_id){
                $check = 1;
                // echo $ventra_notes[1]." <br>".$check." <br>";
            }
                // echo $ventra_notes[1]." <br>".$check." <br>";
              }
              if($check==0){?>
                  <h2><?=$street?> №<?=$build?> <a href="note_home.php?street=<?=$street?>&build=<?=$build?>"><?
                  
                }else {?>
                  <h2><?=$street?> №<?=$build?> <a href="../../action/ventra/edit_note_home_form.php?street=<?=$street?>&build=<?=$build?>"><?
              }
      ?>



    <img src="../../file/icons/ventra/note.png" alt=""> </a></h2> 

    <div>

    <? foreach($ventra_note_current as $ventra_note_currents){?>
        
        
        <table>
            <tr>
                <td><b>Ключи:</b></td>
                <td><?=$ventra_note_currents[3]?></td>
                </tr>
                <tr>
                <td><b>Конкуренты:</b></td>
                <td><?=$ventra_note_currents[4]?></td>
                </tr>
                <tr>
                <td><b>Заметка: </b></td>
                <td><?=$ventra_note_currents[2]?></td>
                </tr>
                </table>
                
         <?   }
            ?>


    </div>
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