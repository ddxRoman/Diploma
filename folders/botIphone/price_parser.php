<?php

// ================== НАСТРОЙКИ ==================
$botToken = '8511376811:AAFCYPduf_S6IHoI1UKZJxnfB9exUFo6B3g';
$chatId   = '523911850';

$products = [
    'iPhone 17 Pro 256GB Синий index' => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-deep-blue/',
    'iPhone 17 Pro 256GB Синий CM' => 'https://cmstore.ru/product/smartfon_apple_iphone_17_pro_256_gb_tyemno_siniy_1sim_esim_/',
    'iPhone 17 Pro 256GB Белый index'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-silver/',
    'iPhone 17 Pro 256GB Белый CM'    => 'https://cmstore.ru/product/smartfon_apple_iphone_17_pro_256_gb_belyy_1sim_esim_/',
    'iPhone 17 Pro 256GB Оранжевый index'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-cosmic-orange/',
    'iPhone 17 Pro 256GB Оранжевый CM'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-cosmic-orange/',
    
];

$storageFile = __DIR__ . '/prices.json';

// ================= ФУНКЦИИ =================

function getPage($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15,
    ]);
    $html = curl_exec($ch);
    curl_close($ch);

    return $html;
}

function parsePrice($html)
{
    if (!$html) {
        return null;
    }

    if (preg_match(
        '/card__price-visible.*?<span>\s*([\d\s]+)\s*₽/su',
        $html,
        $m
    )) {
        return (int) str_replace(' ', '', $m[1]);
    }

    return null;
}



function sendTelegram($token, $chatId, $text)
{
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    curl_exec($ch);
    curl_close($ch);
}

function formatPrice($price)
{
    return number_format($price, 0, '', ' ') . ' ₽';
}

// ================= ЗАГРУЗКА СТАРЫХ ЦЕН =================

$oldPrices = [];
if (file_exists($storageFile)) {
    $oldPrices = json_decode(file_get_contents($storageFile), true) ?? [];
}

$newPrices = [];
$priceChangedMessages = "";

// ================= ПАРСИНГ =================

foreach ($products as $name => $url) {
    $html  = getPage($url);
    $price = parsePrice($html);

    if ($price === null) continue;

    $newPrices[$name] = $price;

    // Проверка изменения цены
    if (isset($oldPrices[$name]) && $oldPrices[$name] != $price) {
        $priceChangedMessages .= "🔔 <b>Изменилась цена</b>\n";
        $priceChangedMessages .= "{$name}\n";
        $priceChangedMessages .= "Было: <s>" . formatPrice($oldPrices[$name]) . "</s>\n";
        $priceChangedMessages .= "Стало: <b>" . formatPrice($price) . "</b>\n\n";
    }
}

// ================= УВЕДОМЛЕНИЕ ОБ ИЗМЕНЕНИИ =================

if ($priceChangedMessages) {
    sendTelegram($botToken, $chatId, $priceChangedMessages);
}

// ================= ЕЖЕДНЕВНЫЙ ОТЧЁТ В 08:00 =================

$currentTime = date('H:i');

if ($currentTime === '10:00' || $currentTime === '20:00') {
    $dailyMessage = "📅 <b>Ежедневные цены (10:00)</b>\n\n";

    foreach ($newPrices as $name => $price) {
        $dailyMessage .= "{$name}\n";
        $dailyMessage .= "Цена: <b>" . formatPrice($price) . "</b>\n\n";
    }

    sendTelegram($botToken, $chatId, $dailyMessage);
}

// ================= СОХРАНЕНИЕ =================

file_put_contents($storageFile, json_encode($newPrices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
