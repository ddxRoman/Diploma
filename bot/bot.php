<?php
session_start();
$token = "6048362058:AAFv50Fltmm_0Ufa-GYzAga-poK1-niyxVo";
$chatId = "2116281958";

$data = $_POST['data'];
$holiday = $_POST['holiday'];
$description = $_POST['description'];
$comments = $_POST['comments'];
$photo = $_POST['url'];
$_SESSION['holidays_day'] = $data;


// echo "дата ".$data."<br>Праздник ".$holiday."<br>Подпись ".$description ."<br>Коммент".$comments."<br>Фото ".$photo;

if ($description == Null) {
    $description = 'Без подписи';
}

if ($photo!="") {

    // Устанавливаем путь к картинке

    // Устанавливаем подпись к картинке
    $caption = "<b>Дата</b> - " . $data . "\n<b>Праздник</b> - " . $holiday . " \n<b>Подпись</b> - " . $description . "\n\n" . $comments;
    // Формируем URL для отправки сообщения

    $url = "https://api.telegram.org/bot$token/sendPhoto?chat_id=$chatId&parse_mode=html";
    // Формируем массив с параметрами запроса
    $postFields = [
        'chat_id' => $chatId,
        'photo' => $photo,
        'caption' => $caption,
    ];
    // Инициализируем cURL сессию
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Отправляем запрос на сервер Telegram
    $output = curl_exec($ch);
    // Закрываем cURL сессию
    curl_close($ch);
    // Отлавливаем возможные ошибки
    if ($output === false) {
        echo "Ошибка отправки сообщения: " . curl_error($ch);
    } else {
        echo "Сообщение успешно отправлено!";
    }
} else {
    $arr = array(
        'Дата - ' => $data,
        'Праздник- ' => $holiday,
        'Подпись: ' => $description, 
        '%0A%0A' => $comments,
    );
    foreach ($arr as $key => $value) {
        $msg .= "<b>" . $key . "</b>" . $value . "%0A";
    }
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&parse_mode=html&text={$msg}", "r");
}
     header ('Location: ../folders/TgBotForm.php');

     