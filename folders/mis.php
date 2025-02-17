<? require_once "../function/checkaut.php";
$page_id = 5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis</title>
</head>
<body class="iframe-body">
    <div class="folders">

            <?
    require_once "../action/connect.php";
    foreach($site as $sites)
    {
        if($sites[3]==$page_id){
        ?><a href="<?=$sites[2]?>" target="_blank"><button class="docs_btn"><?=$sites[1]?></button></a>
                <?
        }
    }
    ?>
            </div>

</body>
</html>