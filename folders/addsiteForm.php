<!DOCTYPE html>
<?
require_once "../action/connect.php";
// require_once "../test.php";
?>
<html lang="en">
<style>
table {

width: 400px;

border-collapse: collapse;

border: 2px solid white;

}

td {

padding: 3px;

border: 1px solid ;

text-align: left;

}
img{
    width: 24px;
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
    <table class="table_addsite">
        <tr>
            <th>id</th>
            <th>Название</th>
            <th class="table_sile" >URL</th>
            <th>Папка</th>
        </tr>
        <div class="sitelist">
            <? foreach ($site as $sites) { 
                    $categories=mysqli_query($connect, "SELECT*FROM `sites_categories` WHERE `id`='$sites[3]'");
                    $categories_name=mysqli_fetch_assoc($categories);
                ?>
                <tr class="site_table">
                    <td><?= $sites[0] ?></td>
                    <td><?= $sites[1] ?></td>
                    <td class="table_sile" ><?= $sites[2] ?></td>
                    <td><?= $categories['name'] ?></td>
                    <td>
                        <a href="../action/editSiteList.php?id=<?=$sites[0]?>"><img class="icon" src="../file/icons/edit-svgrepo-com.svg" title="Редактировать"></a>
                    </td>
                    <td>
<script type="text/javascript"> 
$("#submit").click(function () { 
    var name = $("#name").val(); 
    var marks = $("#marks").val(); 
    var str = "You Have Entered " 
        + "Name: " + name 
        + " and Marks: " + marks; 
    $("#modal_body").html(str); 
}); 
</script> 
                </tr>
            <? } ?>
    </table>


    </div>
</body>

</html>
<!-- echo $sites[1]." - ".$sites[2]." - ".$sites[3]." - ".$sites[4]."<br>"; -->