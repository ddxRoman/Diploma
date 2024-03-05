<link rel="stylesheet" href="../css/adminStyle.css">
<div class="Tg-Block-Form">
    <form action="../bot/bot.php" method="post">
        <input class="input_TG" name="data" type="date">
        <input class="input_TG" type="text" name="holiday" placeholder="Праздник"><br>
        <input class="input_TG" type="text" name="description" placeholder="Подпись"><br>
        <input class="input_TG" type="text" name="url" placeholder="Ссылка на картинку"><br>
        <textarea class="txtArea_TG"  name="comments" placeholder="Комментарий"></textarea><br>
        <button class="btn_TG" type="submit">Отправить</button>
    </form>
</div>