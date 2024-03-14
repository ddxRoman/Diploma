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
            <? foreach ($site as $sites) { ?>
                
                <tr class="site_table">
                    <td><?= $sites[0] ?></td>
                    <td><?= $sites[1] ?></td>
                    <td class="table_sile" ><?= $sites[2] ?></td>
                    <td><?= $sites[3] ?></td>
                    <td>
                        <a href=""><img class="icon" src="../file/icons/edit-svgrepo-com.svg" title="Редактировать"></a>
                    </td>
                    <td>


                    <button type="button"  data-toggle="modal"
    data-target="#exampleModal"
    id="submit"> 
    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img class="icon" src="../file/icons/delete.svg" title="Удалить">
                        </a> 
</button> 

                       
                    </td>
                    <!-- <div class="container mt-2">  -->
<!-- Input field to accept user input -->
<!-- Name: <input type="text" name="name"
    id="name"><br><br> 
Marks: <input hidden value="" type="text" name="marks"
    id="marks"><br><br> 
<button type="button" class="btn btn-primary 
    btn-sm" data-toggle="modal"
    data-target="#exampleModal"
    id="submit"> 
    Submit 
</button>  -->
<!-- Modal -->
<div class="modal fade" id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"> 
    
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title"
                    id="exampleModalLabel"> 
                    Confirmation  <?= $sites[1] ?> this task
                </h5> 
                
                <button type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"> 
                    <span aria-hidden="true"> 
                        × 
                    </span> 
                </button> 
            </div> 

            <div class="modal-body"> 

                <!-- Data passed is displayed 
                    in this part of the 
                    modal body -->
                <h6 id="modal_body"></h6> 
                <button type="button"
                    class="btn btn-success btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    id="submit"> 
                    Submit 
                </button> 
            </div> 
        </div> 
    </div> 
</div> 
<!-- </div>  -->


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