<? 
require_once "../function/checkaut.php";
$page_id = 4;
?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
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