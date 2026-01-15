<?php

$botToken = '';
$chatId   = '';

$products = [
    'iPhone 17 Pro 256GB Синий' => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-deep-blue/',
    'iPhone 17 Pro 256GB Белый'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-silver/',
    'iPhone 17 Pro 256GB Оранжевый'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-cosmic-orange/',
];

// ---------- функции (те же, что и раньше) ----------

function getPage($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15,
    ]);
    return curl_exec($ch);
}

function parsePrice($html)
{
    if (!$html) {
        return 'не найдена';
    }

    // Ищем <div class="card__price-visible"><span>109 990 ₽</span>
    if (preg_match(
        '/card__price-visible.*?<span>\s*([\d\s]+)\s*₽/su',
        $html,
        $m
    )) {
        return trim($m[1]) . ' ₽';
    }

    return 'не найдена';
}


function sendTelegram($token, $chatId, $text, $keyboard = null)
{
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'HTML',
    ];

    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    curl_exec($ch);
    curl_close($ch);
}

// ---------- читаем сообщения ----------

$updates = json_decode(
    file_get_contents("https://api.telegram.org/bot{$botToken}/getUpdates"),
    true
);

if (empty($updates['result'])) {
    exit;
}

$lastUpdate = end($updates['result']);
$text = $lastUpdate['message']['text'] ?? '';

// ---------- кнопка ----------

$keyboard = [
    'keyboard' => [
        [['text' => '📱 Получить цену сейчас']]
    ],
    'resize_keyboard' => true
];

// ---------- логика ----------

if ($text === '/start') {
    sendTelegram(
        $botToken,
        $chatId,
        "Привет! Нажми кнопку ниже 👇",
        $keyboard
    );
}

if ($text === '📱 Получить цену сейчас') {

    $message = "📱 <b>Актуальные цены</b>\n\n";

    foreach ($products as $name => $url) {
        $html  = getPage($url);
        $price = parsePrice($html);

        $message .= "{$name}\n";
        $message .= "Цена: <b>{$price}</b>\n\n";
    }

    sendTelegram($botToken, $chatId, $message, $keyboard);
}
