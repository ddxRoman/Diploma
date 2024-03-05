<?php

$botToken ="6048362058:AAFv50Fltmm_0Ufa-GYzAga-poK1-niyxVo";
$chatId = "2116281958";

// Подключаем Guzzle HTTP
require '../vendor/autoload.php';

use GuzzleHttp\Client;

// Токен вашего бота
$token = '6048362058:AAFv50Fltmm_0Ufa-GYzAga-poK1-niyxVo';

// ID чата, в который нужно отправить фото
$chatId = '2116281958';

// Путь к файлу с изображением
$photoPath = 'https://www.orsdiplom.h1n.ru/file/avatar/ava.jpeg';

// Создаем экземпляр Guzzle HTTP клиента
$client = new Client([
    'base_uri' => 'https://api.telegram.org/bot' . $token . '/'
    // https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$msg}","r"
]);

// Отправляем запрос на сервер Телеграма для отправки фото
$response = $client->request('POST', 'sendPhoto', [
    'multipart' => [
        [
            'name' => 'chat_id',
            'contents' => $chatId
        ],
        [
            'name' => 'photo',
            'contents' => fopen($photoPath, 'r'),
            'filename' => basename($photoPath)
        ]
    ]
]);

// Обрабатываем ответ
$body = $response->getBody();
$json = json_decode($body);
if ($json->ok) {
    echo 'Фото успешно отправлено!';
} else {
    echo 'Ошибка при отправке фото: ' . $json->description;
}
?>