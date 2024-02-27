<? require_once "../function/checkaut.php";
$page_id = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
</head>
<body class="iframe-body">
    <div class="folders">

    <!-- <a href="https://docs.google.com/spreadsheets/d/1f6g5RMrzm2Gn0KAlKBroDGILou2tWEqRqbYQOBQaDqA/edit#gid=38707061" target="_blank"><button>ЛИС Впровадження</button></a> -->
    <!-- <a href="https://docs.google.com/spreadsheets/d/15FS6sJC2ADPFrmeqwfog1LjkerQM9W8bh7Lq1JgQ08U/edit#gid=691924434" target="_blank"><button>Файл внедрения</button></a> -->
    <!-- <a href="https://docs.google.com/document/d/14qUnHAUOo6gIP_w40ezxyS4nakGHloNC3uOmWgmvruY/edit?disco=AAAAc2LxseQ" target="_blank"><button>Инстр Внедрения</button></a> -->
    <!-- <a href="https://docs.google.com/document/d/1XG_GLM7O2o95q02mmyiOGVMFOT9togEHu0RV7xvmU8g/edit" target="_blank"><button>Инструкция</button></a> -->
    <!-- <a href="https://docs.google.com/spreadsheets/d/1831n04opuq0QCen2fzRKy6H8lgLxIxD5sODwKxvh6s4/edit#gid=1808514170" target="_blank"><button>Шорт Аналики</button></a> -->
   
   <?
    require_once "../action/connect.php";
    foreach($site as $sites)
    {
        if($sites[3]==$page_id){
        ?><a href="<?=$sites[2]?>" target="_blank"><button class="docsFolders_btn"><?=$sites[1]?></button></a><?
        }
    }
    ?>
</div> 
</body>
</html>