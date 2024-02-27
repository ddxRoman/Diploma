<? require_once "../function/checkaut.php";
$page_id = 2;
?>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <body class="iframe-body">
    <div class="folders">
<!-- <a href="https://drive.google.com/drive/folders/18AlQjy7OemvXCSv0E2XLp8KGJYvkrsIQ" target="_blank"><button>Анализаторы</button></a>
<a href="https://drive.google.com/drive/folders/1qsLCeBDutlGuMfTqMoVAyzQQkY1jCHwH" target="_blank"><button>Документы</button></a>
<a href="https://drive.google.com/drive/folders/1qIpO9FTKv8vOoz1II-NO4tuoOylko8R8" target="_blank"><button>Слушалки</button></a><br> -->


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