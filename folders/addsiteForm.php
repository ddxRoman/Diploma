<!DOCTYPE html>
<?
require_once "../action/connect.php";
?>
<html lang="en">
<style>
table {
border-collapse: collapse;
border: 2px  ;
}

td {
padding: 3px;
border: 1px solid ;
text-align: left;
}

.table_sile{
    width: 300px;
    white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

img{
    width: 24px;
}

a{
    color: #000;
    text-decoration: none;
}
</style>


<body>
    <div class="form_addCreeds">
        <form action="../action/addsiteList.php" method="post">
            <input type="text" placeholder="URL" name="url">
            <input type="text" placeholder="name" name="name">
            <select name="categories">
                <option value="">Категория</option>
                <? foreach ($sites_categorie as $sites_categories) if ($sites_categories[4] == 0) { { ?>
                        <option value="<?= $sites_categories[0] ?>"><?= $sites_categories[1] ?></option>
                <? }
                } ?>
            </select>
            <button class="add_creeds_btn">Добавить</button>
        </form>
    </div>
    <div class="sitelist">
    <table class="table_addsite">
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>URL</th>
            <th>Папка</th>
        </tr>

            <? foreach ($site as $sites) { 
                    $categories=mysqli_query($connect, "SELECT*FROM `sites_categories` WHERE `id`='$sites[3]'");
                    $categories=mysqli_fetch_assoc($categories);
                ?>
                <tr class="site_table">
                    <td><?= $sites[0] ?></td>
                    <td class="url_table_colomn"><?= $sites[1] ?></td>
                    <td class="table_sile"> <a href="<?= $sites[2] ?>" target="_blank" title="<?= $sites[2] ?>"><?= $sites[2] ?></a></td>
                    <td><?= $categories['name'] ?></td>
                    <td>
                        <a href="../action/editSiteList.php?id=<?=$sites[0]?>"><img class="icon" src="../file/icons/edit-svgrepo-com.svg" title="Редактировать"></a>
                    </td>
                    
                </tr>
            <? } ?>
    </table>
    </div>
</body>

</html>
<!-- echo $sites[1]." - ".$sites[2]." - ".$sites[3]." - ".$sites[4]."<br>"; -->