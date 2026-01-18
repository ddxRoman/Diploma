<?php

// ================= НАСТРОЙКИ =================


// ================= ТОВАРЫ =================
$products = [
    'iPhone 17 Pro 256GB Синий'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-deep-blue/',
    'iPhone 17 Pro 256GB Белый'    => 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-silver/',
    'iPhone 17 Pro 256GB Оранжевый'=> 'https://indexiq.ru/product/apple-iphone-17-pro-256gb-cosmic-orange/',
];

$recommendProducts = [
    'https://indexiq.ru/product/poco-f7-pro-12-512gb-5g-silver-eu/',
    'https://indexiq.ru/product/huawei-pura-80-12-256gb-frosted-white-hed-lx9-eac/',
    'https://indexiq.ru/product/xiaomi-15t-12-512gb-grey-eu/',
    'https://indexiq.ru/product/honor-400-pro-12-256gb-black-dnp-nx9/',
    'https://indexiq.ru/product/poco-f8-pro-12-256gb-5g-blue-eu/',
    'https://indexiq.ru/product/nubia-z70s-ultra-12-256gb-classic-black-bez-adaptera/',
    'https://indexiq.ru/product/honor-magic8-pro-12-512gb-sunrise-gold-bkq-n49/',
    'https://indexiq.ru/product/huawei-pura-80-ultra-16-512gb-golden-black-lmu-lx9-eu/',
    'https://indexiq.ru/product/honor-magic7-pro-16-1tb-lunar-shadow-grey-ptp-n49/',
    'https://indexiq.ru/product/asus-rog-phone-9-pro-16-512gb-phantom-black/',
];

// ================= БАЗОВЫЕ ФУНКЦИИ =================
function getPage($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 20,
    ]);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function parsePrice($html)
{
    if (!$html) return 'не найдена';

    if (preg_match('/card__price-visible.*?<span>\s*([\d\s]+)\s*₽/su', $html, $m)) {
        return trim($m[1]) . ' ₽';
    }
    return 'не найдена';
}

function priceToInt($price)
{
    return (int)str_replace([' ', '₽'], '', $price);
}

function parseTitle($html)
{
    if (preg_match('/<h1[^>]*>(.*?)<\/h1>/su', $html, $m)) {
        return trim(strip_tags($m[1]));
    }
    return 'смартфон';
}

function parseChargePower($html)
{
    if (preg_match('/Мощность зарядки.*?<div class="tech-value">\s*([^<]+)<\/div>/su', $html, $m)) {
        return trim($m[1]);
    }
    return 'быстрой зарядкой';
}

// ✅ БОЛЬШАЯ КАРТИНКА (width:100%)
function parseImage($html)
{
    if (preg_match(
        '~<img[^>]+src="(/storage/photo/resized/xy_1200x1200/[^"]+)"~u',
        $html,
        $m
    )) {
        return 'https://indexiq.ru' . $m[1];
    }
    return null;
}


// ================= TELEGRAM =================
function sendTelegram($token, $chatId, $text, $keyboard = null)
{
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];
    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }

    $ch = curl_init("https://api.telegram.org/bot{$token}/sendMessage");
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    curl_exec($ch);
    curl_close($ch);
}

function sendTelegramPhoto($token, $chatId, $photoUrl, $caption)
{
    $data = [
        'chat_id' => $chatId,
        'photo' => $photoUrl,
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init("https://api.telegram.org/bot{$token}/sendPhoto");
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    curl_exec($ch);
    curl_close($ch);
}

// ================= UPDATE =================
$update = json_decode(file_get_contents('php://input'), true);
$chatId = $update['message']['chat']['id'] ?? null;
$text   = $update['message']['text'] ?? '';
if (!$chatId) exit;

// ================= КНОПКА =================
$keyboard = [
    'keyboard' => [[['text' => '📱 Получить цену сейчас']]],
    'resize_keyboard' => true
];

// ================= ЛОГИКА =================
if ($text === '/start') {
    sendTelegram($botToken, $chatId, "Привет! Нажми кнопку ниже 👇", $keyboard);
    exit;
}

if ($text === '📱 Получить цену сейчас') {

    // ===== IPHONE ДЛЯ СРАВНЕНИЯ =====
    $iphoneHtml  = getPage($products['iPhone 17 Pro 256GB Синий']);
    $iphonePrice = priceToInt(parsePrice($iphoneHtml));

    // ===== СЛУЧАЙНЫЙ ТОВАР =====
    $randomUrl  = $recommendProducts[array_rand($recommendProducts)];
    $randomHtml = getPage($randomUrl);

    $recTitle  = parseTitle($randomHtml);
    $recPrice  = priceToInt(parsePrice($randomHtml));
    $recCharge = parseChargePower($randomHtml);
    $recImage  = parseImage($randomHtml);

    $diff = $iphonePrice - $recPrice;

    // ===== ОДИН ТЕКСТ =====
    $message  = "🔥🔥🔥 <b>А может все таки лучше купить</b> 🔥🔥🔥";
    $message .= "<b><a href=\"{$randomUrl}\">{$recTitle}</a></b>\n";
    $message .= "Цена: <b>" . number_format($recPrice, 0, '', ' ') . " ₽</b>\n";
    $message .= "Это на <b>" . number_format($diff, 0, '', ' ') . " ₽</b> дешевле iPhone 17 Pro\n";
    $message .= "· NFC 💳\n· Банковские приложения 🏦\n· Быстра зарядка ⚡ <b>{$recCharge}</b>\n\n";

    $message .= "📱 <b>Актуальные цены iPhone</b>\n\n";

    foreach ($products as $name => $url) {
        $price = parsePrice(getPage($url));
        $message .= "{$name}\n";
        $message .= "Цена: <b>{$price}</b>\n";
        $message .= "<a href=\"{$url}\">Открыть товар</a>\n\n";
    }

    // ===== ОТПРАВКА ОДНИМ СООБЩЕНИЕМ =====
    if ($recImage) {
        sendTelegramPhoto($botToken, $chatId, $recImage, $message);
    } else {
        sendTelegram($botToken, $chatId, $message, $keyboard);
    }
}

