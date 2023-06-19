<?php
session_start();
require_once '../connect.php'; // Проверка подключения к БД
require_once 'StyleAndSettings.php'; // Проверка подключения к БД
$id_user= $_SESSION['user']['id'];
$setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];
$btn_color=$setting['btn_color'];

?>
<div class="header_settings">
    <a href="../../index_admin.php">
    <button>На главную</button>
</a>
</div>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Тема')">Тема</button>
  <button class="tablinks" onclick="openCity(event, 'Кнопки')">Кнопки</button>
  <button class="tablinks" onclick="openCity(event, 'Профиль')">Профиль</button>
</div>

<div id="Тема" class="tabcontent">
<div class="links">
                <form action="color.php" name="bg" method="post">
                <table>
<tr>
    <th>Select  background: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Select text color:</th>
    <th><input name="txtColor" type="color" value="<?=$text_color?>"><br></th>
</tr>
<tr>
    <th>Select button color:</th>
    <th><input name="btn_color" type="color" value="<?=$btn_color?>"><br></th>
</tr>
</table>
    <button>Применить</button>
    </form>


        </div>
        


        
</div>


<div id="Кнопки" class="tabcontent">

<h3>Добавление кнопок:</h3>
<form action="addbutton.php?id=<?=$id_user?>" method="post" >
    <input required name="button" type="text" placeholder="Название кнопки">
    <input required type="text" name="url" placeholder="URL кнопки"><br>
    <br>
    <button>Добавить</button>
</form>
</div>

<div id="Профиль" class="tabcontent">

</div>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem maiores mollitia totam delectus, eligendi possimus perspiciatis est, voluptates asperiores iure quo amet eum! Unde corrupti perspiciatis deleniti exercitationem harum, cumque consequuntur modi, nesciunt tenetur earum dolores a, repellendus saepe at repudiandae? Quam dolorem dignissimos veritatis optio ab quisquam, expedita vitae suscipit doloribus maxime adipisci quas dolores facere ipsum obcaecati. Soluta, dolorem enim. Vitae aut magni soluta quaerat. Modi nulla, cum beatae natus adipisci recusandae delectus ipsum, eius veritatis laborum minima aliquid rem quo eos? Error officia at ratione magni sit totam, fugiat esse pariatur ab reprehenderit tempora quidem, laudantium est suscipit impedit perspiciatis rem cum repellendus deserunt hic labore voluptate iste? Doloribus deserunt inventore labore veniam possimus assumenda amet placeat voluptatibus, ipsum dolore eaque aliquid praesentium fugiat tenetur voluptates id provident aut tempore illo culpa explicabo neque architecto. Reiciendis animi exercitationem voluptate doloribus! Distinctio accusantium nam alias ad repudiandae accusamus. Veniam inventore nemo ullam distinctio molestias autem praesentium debitis qui, ea quibusdam quo saepe quasi, eius in ab magnam et veritatis laudantium! Doloremque cupiditate sint veritatis omnis quaerat natus laboriosam nesciunt fuga voluptatibus! Aliquid, aliquam? Enim sed aspernatur quidem dignissimos ab voluptas velit quibusdam, cumque optio. Nobis aspernatur, reiciendis reprehenderit laudantium harum consequuntur placeat, distinctio magni neque ex itaque modi accusantium natus aperiam libero similique aliquam. Dolore debitis ipsam accusantium, voluptatibus, odit porro expedita quod ratione corporis alias fugit aliquid quasi atque dolorum praesentium pariatur quisquam dicta quam iste ipsa, officia facilis aspernatur! Necessitatibus magni nesciunt, libero ipsum doloremque adipisci, quas cum temporibus ea enim recusandae.</p>

<style>
    input{
        margin-top: 5px;
    }
  .tab {
    overflow: hidden;
    border: 1px solid #4CAF50;
    background-color: #C8E6C9;
}

.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

.tab button:hover {
    background-color: #FFEB3B;
}

.tab button.active {
    background-color: #4CAF50;
	color: #fff;
}

.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #599735;    
    border-top: none;
}
.header_settings{
    display: grid;
  justify-content: end;

}
body{
    background-color: #999999;
}
</style>

<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>