<!DOCTYPE html>
<?
require_once "../action/connect.php";
// require_once "../test.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    	<!-- Import bootstrap cdn -->
	<link rel="stylesheet" href= 
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		integrity= 
"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
		crossorigin="anonymous"> 

	<!-- Import jquery cdn -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity= 
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"> 
	</script> 
	
	<script src= 
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity= 
"sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"> 
	</script> 
    <!-- На главной индекс фоллов, на остальныйх NO при пагинации. NOindex NOfollow на технических страницах, превнекст при каталоге с пагинацией (Договора, документы и тд, не важные для юзера)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="js/text_line_animation.js"></script>
    <script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

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
    <table>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>URL</th>
            <th>Папка</th>
        </tr>
        <div class="sitelist">
            <? foreach ($site as $sites) { ?>
                
                <tr class="site_table">
                    <td><?= $sites[0] ?></td>
                
                    <td><?= $sites[1] ?></td>
                    <td><?= $sites[2] ?></td>
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







                    <div class="container mt-2"> 

<!-- Input field to accept user input -->
Name: <input type="text" name="name"
    id="name"><br><br> 

Marks: <input hidden value="" type="text" name="marks"
    id="marks"><br><br> 

<!-- Button to invoke the modal -->
<button type="button" class="btn btn-primary 
    btn-sm" data-toggle="modal"
    data-target="#exampleModal"
    id="submit"> 
    Submit 
</button> 

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
</div> 


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