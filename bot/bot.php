<?php
session_start();
// Проверь путь! Если bot.php в папке bot, а connect в action:
require_once '../action/connect.php'; 



$data = $_POST['data'];
$holiday = $_POST['holiday'];
$description = $_POST['description'] ?: 'Без подписи';
$comments = $_POST['comments'];
$url_from_input = $_POST['url'];
$_SESSION['holidays_day'] = $data;

$photo = ""; 

// --- ПАРСЕР С ОБХОДОМ PRELOAD.GIF ---
if (!empty($url_from_input)) {
    $ch = curl_init($url_from_input);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    curl_close($ch);

    if ($html) {
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new DOMXPath($dom);
        
        // Ищем все картинки с классом img-fluid
        $nodes = $xpath->query("//img[contains(@class, 'img-fluid')]");

        if ($nodes->length > 0) {
            $node = $nodes->item(0);
            
            // ПРИОРИТЕТ: сначала смотрим data-src (там реальная картинка)
            // Если его нет, тогда берем обычный src
            $src = $node->getAttribute('data-src');
            if (!$src) {
                $src = $node->getAttribute('src');
            }

            // Если всё еще находим preload.gif или пустоту, пробуем найти по другому атрибуту
            if (strpos($src, 'preload.gif') !== false || !$src) {
                 // Иногда реальный путь лежит в data-original или подобных
                 $src = $node->getAttribute('data-original');
            }
            
            if ($src) {
                // Отрезаем параметры типа ?t=123 (они часто мешают Telegram)
                $img_url = explode('?', $src)[0];
                
                // Делаем ссылку абсолютной
                if (strpos($img_url, 'http') === false) {
                    $base = parse_url($url_from_input);
                    $photo = $base['scheme'] . '://' . $base['host'] . $img_url;
                } else {
                    $photo = $img_url;
                }
            }
        }
    }
}

// Если парсер не нашел картинку по классу, но юзер ввел прямую ссылку на .jpg/.png
if (empty($photo) && !empty($url_from_input)) {
    $photo = $url_from_input;
}

// --- ОТПРАВКА ---

// Добавляем ссылку на картинку в текст (как ты просил)
$caption = "<b>Дата</b> - $data\n";
$caption .= "<b>Праздник</b> - $holiday\n";
$caption .= "<b>Подпись</b> - $description\n";
// if (!empty($photo)) {
//     $caption .= "<b>URL картинки:</b> " . $photo . "\n";
// }
$caption .= "\n" . $comments;

if (!empty($photo)) {
    // Отправка ФОТО
    $send_url = "https://api.telegram.org/bot$token/sendPhoto";
    $params = [
        'chat_id' => $chatId,
        'photo'   => $photo,
        'caption' => $caption,
        'parse_mode' => 'html'
    ];
} else {
    // Отправка только ТЕКСТА
    $send_url = "https://api.telegram.org/bot$token/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text'    => $caption,
        'parse_mode' => 'html'
    ];
}

$ch = curl_init($send_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

header('Location: ../folders/TgBotForm.php');
exit();