<? session_start();
if($_SESSION['holidays_day']=='') {$last_day_holidays=date('Y-m-d');}
else{$last_day_holidays=$_SESSION['holidays_day'];}

?>

<style>
    .input_TG{
        width: 50%;
        height: 35px;
        margin-bottom: 3%;
    }
    .input_TG_hooliday{
        width: 35%;
        height: 35px;
        margin-bottom: 3%;

    }
    .input_TG_date{
        width: 15%;
        height: 35px;
    }
    .Tg-Block-Form{
padding-left: 10%;
    }
    textarea{
        width: 70%;
        height: 100px;
        margin-bottom: 5%;
    }
</style>


<div class="Tg-Block-Form">
    <form action="../bot/bot.php" method="post">   
        <input required class="input_TG_date" name="data" type="date" value="<?= $last_day_holidays ?>" autofocus>
        <input required class="input_TG_hooliday" type="text" name="holiday" placeholder="Праздник"><br>
        <input class="input_TG" type="text" name="description" placeholder="Подпись"><br>
        <input class="input_TG" type="text" name="url" placeholder="Ссылка на картинку"><br>
        <textarea class="txtArea_TG"  name="comments" placeholder="Комментарий"></textarea><br>
        <button class="btn_TG" type="submit">Отправить</button>
    </form>
</div>