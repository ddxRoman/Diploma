<?php

// Устанавливаем токен бота и ID чата
$token = "YOUR_BOT_TOKEN";
$chatId = "YOUR_CHAT_ID";

// Устанавливаем путь к картинке
$photo = "path/to/your/image.jpg";

// Устанавливаем подпись к картинке
$caption = "Это картинка с подписью";

// Формируем URL для отправки сообщения
$url = "https://api.telegram.org/bot$token/sendPhoto";

// Формируем массив с параметрами запроса
$postFields = [
    'chat_id' => $chatId,
    'photo' => new CURLFile(realpath($photo)),
    'caption' => $caption
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
