<?
require_once 'connect.php';
$site_id=$_GET['id'];
$site_edit=mysqli_query($connect, "SELECT*FROM `sites` WHERE `id`='$site_id'");
$site_edit=mysqli_fetch_assoc($site_edit);
?>

<form action="editsiteListBack.php" method="post">
    <input name="url" value="<?=$site_edit['url']?>"  placeholder="URL" type="text">
    <input name="name" value="<?=$site_edit['name']?>" placeholder="Name" type="text">
    <input name="id" type="text" hidden value="<?=$site_id?>">
    <select name="categories">
                <!-- <option value="">Категория</option> -->
                <?
                foreach ($sites_categorie as $sites_categories) if ($sites_categories[4] == 0) { 
                    echo $sites_categories[0];
                    if($sites_categories[0]!=$site_edit['categories_id'])
                    { 

                    ?>    <option value="<?=$sites_categories[0]?>" ><?= $sites_categories[1]?></option><?
                    }else{

                    ?>
                    <option value="<?= $sites_categories[0]?>" selected="selected"><?= $sites_categories[1] ?></option>
                        <?} }
                 ?>
            </select>
            <br>
            <br>
            <button>Сохранить</button> 

</form>

<form action="deleteSite.php" method="post">
<input name="id" type="text" hidden value="<?=$site_id?>">
                <button class="delete_btn">Удалить</button>
           </form>