<!DOCTYPE html>
<? 
require_once "../action/connect.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="form_addCreeds">
<form action="../action/addsiteList.php" method="post">
    <input type="text" placeholder="URL" name="url">
    <input type="text" placeholder="name" name="name">
    <select name="categories">
        <option value="">Категория</option>
        <? foreach($sites_categorie as $sites_categories) if($sites_categories[4]==0){ {?>
        <option value="<?=$sites_categories[0]?>"><?=$sites_categories[1]?></option>
       <? }}?>
    </select>
<button class="add_creeds_btn">Добавить</button>
</form>
    </div>
</body>
</html>