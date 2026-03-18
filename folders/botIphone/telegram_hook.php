<?php

$botToken = '8511376811:AAFCYPduf_S6IHoI1UKZJxnfB9exUFo6B3g';
$chatId   = '523911850';

$products = [
    'Watch 11 42mm Rose Gold' => 'https://indexiq.ru/product/apple-watch-series-11-42mm-rose-gold-aluminum-case-with-light-blush-sport-band-m-l-meu44/',
    'Apple Watch Series 10 LTE 42mm Rose Gold'    => 'https://indexiq.ru/product/apple-watch-series-10-lte-42-mm-mwxc3/',
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
