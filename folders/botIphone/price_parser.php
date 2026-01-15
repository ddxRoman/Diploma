<?php

// ================== НАСТРОЙКИ ==================
$botToken = '';
$chatId   = '';

$products = [
    'iPhone 17 Pro 256GB Синий' => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-deep-blue/',
    'iPhone 17 Pro 256GB Белый'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-silver/',
    'iPhone 17 Pro 256GB Оранжевый'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-cosmic-orange/',
    
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

if ($currentTime === '08:00') {
    $dailyMessage = "📅 <b>Ежедневные цены (08:00)</b>\n\n";

    foreach ($newPrices as $name => $price) {
        $dailyMessage .= "{$name}\n";
        $dailyMessage .= "Цена: <b>" . formatPrice($price) . "</b>\n\n";
    }

    sendTelegram($botToken, $chatId, $dailyMessage);
}

// ================= СОХРАНЕНИЕ =================

file_put_contents($storageFile, json_encode($newPrices, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
