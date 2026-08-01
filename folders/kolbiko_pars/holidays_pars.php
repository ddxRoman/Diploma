<?php
$csvFile = __DIR__ . '/holidays.csv';
$cacheFile = __DIR__ . '/cache.json';

// --- 1. ОБРАБОТКА ЗАГРУЗКИ ФАЙЛА ---
if (isset($_FILES['csv_upload']) && $_FILES['csv_upload']['error'] == 0) {
    move_uploaded_file($_FILES['csv_upload']['tmp_name'], $csvFile);
    if (file_exists($cacheFile)) unlink($cacheFile); // Удаляем старый кэш при новом файле
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=uploaded");
    exit;
}

// --- 2. ФУНКЦИЯ ПАРСИНГА (С КЭШЕМ) ---
function getProductData($url) {
    $opts = ["http" => ["method" => "GET", "header" => "User-Agent: Mozilla/5.0\r\n"]];
    $context = stream_context_create($opts);
    $html = @file_get_contents($url, false, $context);
    if (!$html) return ['title' => 'Просто открытка поздравление', 'img' => ''];

    $doc = new DOMDocument();
    @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xpath = new DOMXPath($doc);
    
    $titleNode = $xpath->query('//h1[contains(@class, "article-title-h1")]');
    $title = ($titleNode->length > 0) ? trim($titleNode->item(0)->nodeValue) : 'Товар не найден';
    
    $imgNode = $xpath->query('//div[contains(@class, "image-recipe")]//img');
    $img = '';
    if ($imgNode->length > 0) {
        $node = $imgNode->item(0);
        $img = $node->getAttribute('data-src') ?: ($node->getAttribute('data-original') ?: $node->getAttribute('src'));
        if ($img) $img = explode('?', $img)[0];
    }
    if ($img && strpos($img, 'http') !== 0) $img = "https://kolbiko.ru" . $img;
    
    return ['title' => $title, 'img' => $img];
}

// --- 2.1 ФУНКЦИЯ ПЕРЕФОРМАТИРОВАНИЯ ДАТЫ (Месяц/День/Год -> День/Месяц/Год) ---
function formatDateToDMY($date) {
    $date = trim($date);
    if ($date === '') return $date;

    // Пробуем распознать дату в формате M/D/Y (в т.ч. M-D-Y)
    $normalized = str_replace('-', '/', $date);
    $parts = explode('/', $normalized);

    if (count($parts) === 3) {
        [$month, $day, $year] = $parts;
        if (is_numeric($month) && is_numeric($day) && is_numeric($year)) {
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);
            $day = str_pad($day, 2, '0', STR_PAD_LEFT);
            if (strlen($year) === 2) $year = '20' . $year;
            return "$day/$month/$year";
        }
    }

    // Если формат не распознан — возвращаем как есть
    return $date;
}

// --- 3. ПОЛУЧЕНИЕ ДАННЫХ (ИЗ КЭША ИЛИ ПАРСЕРОМ) ---
$finalData = [];
if (file_exists($cacheFile) && !isset($_GET['force_update'])) {
    // Берем из кэша (мгновенно)
    $finalData = json_decode(file_get_contents($cacheFile), true);
} elseif (file_exists($csvFile)) {
    // Парсим CSV
    $content = file_get_contents($csvFile);
    $content = preg_replace("/^\xEF\xBB\xBF/", '', $content);
    $stream = fopen('php://memory', 'r+');
    fwrite($stream, $content);
    rewind($stream);
    
    $firstLine = fgets($stream);
    $sep = (strpos($firstLine, ';') !== false) ? ';' : ',';
    rewind($stream);
    fgetcsv($stream, 1000, $sep); // Пропуск шапки

    while (($row = fgetcsv($stream, 1000, $sep)) !== FALSE) {
        if (count($row) >= 2) {
            $url = $row[2] ?? ''; // ИЗМЕНЕНО: Вынесли URL в переменную
            $info = getProductData($url);
            $finalData[] = [
                'date' => $row[0],
                'holiday' => $row[1],
                'url' => $url, // ИЗМЕНЕНО: Добавили URL в массив для кэша
                'title' => $info['title'],
                'img' => $info['img']
            ];
        }
    }
    fclose($stream);
    // Сохраняем результат в кэш
    file_put_contents($cacheFile, json_encode($finalData, JSON_UNESCAPED_UNICODE));
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Kolbiko Content Manager</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; padding: 20px; color: #333; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .header-flex { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f0f0f0; padding-bottom: 20px; margin-bottom: 20px; }
        .upload-box { background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px dashed #ccc; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background: #007bff; color: white; font-size: 13px; text-transform: uppercase; }
        .thumb { width: 70px; border-radius: 4px; cursor: pointer; transition: 0.2s; }
        .thumb:hover { transform: scale(1.2); box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; font-size: 13px; }
        .btn-green { background: #28a745; color: white; }
        .btn-blue { background: #007bff; color: white; }
        .btn-update { background: #ffc107; color: #333; }
        input[type="text"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .status { color: #28a745; font-weight: bold; margin-bottom: 10px; }
        .holiday-link { color: #000000; text-decoration: none; font-weight: 300; } /* ИЗМЕНЕНО: Стиль для ссылки */
        .holiday-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-flex">
        <div>
            <h2 style="margin:0">Сетка постов</h2>
            <?php if (file_exists($cacheFile)): ?>
                <small style="color: #666;">Данные загружены из кэша</small>
            <?php endif; ?>
        </div>
        
        <div class="upload-box">
            <form action="" method="post" enctype="multipart/form-data" style="display: flex; gap: 10px; align-items: center;">
                <input type="file" name="csv_upload" accept=".csv" required>
                <button type="submit" class="btn btn-blue">Загрузить CSV</button>
            </form>
        </div>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <div class="status">✓ Файл успешно загружен и обработан!</div>
    <?php endif; ?>

    <?php if (!empty($finalData)): ?>
        <div style="margin-bottom: 15px;">
            <a href="?force_update=1" class="btn btn-update">🔄 Перепарсить данные с сайта</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:90px">Дата</th>
                    <th style="width:180px">Праздник</th>
                    <th style="width:80px">Фото</th>
                    <th>Подпись</th>
                    <th style="width:130px">Текст</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($finalData as $index => $item): $rowId = "row_$index"; ?>
                <tr id="<?= $rowId ?>">
                    <td class="js-date"><?= htmlspecialchars(formatDateToDMY($item['date'])) ?></td>
                    <td class="js-holiday">
                        <?php if (!empty($item['url'])): ?>
                            <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="holiday-link"><strong><?= htmlspecialchars($item['holiday']) ?></strong></a>
                        <?php else: ?>
                            <strong><?= htmlspecialchars($item['holiday']) ?></strong>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center">
                        <?php if ($item['img']): ?>
                            <img src="<?= $item['img'] ?>" class="thumb" title="ПКМ -> Копировать" onclick="alert('Копируй правой кнопкой мыши!')">
                        <?php else: ?>
                            <small style="color:#999">Нет</small>
                        <?php endif; ?>
                    </td>
                    <td><input type="text" value="<?= htmlspecialchars($item['title']) ?>" id="input_<?= $rowId ?>"></td>
                    <td><button class="btn btn-green" onclick="copyRowText('<?= $rowId ?>')">КОПИРОВАТЬ</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center; color:#999; padding: 50px;">Загрузите CSV файл, чтобы начать работу.</p>
    <?php endif; ?>
</div>

<script>
function copyRowText(rowId) {
    const row = document.getElementById(rowId);
    const date = row.querySelector('.js-date').innerText.trim();
    const holiday = row.querySelector('.js-holiday').innerText.trim();
    const caption = document.getElementById('input_' + rowId).value.trim();

    const plainText = `*Дата* - ${date}\n*Праздник* - ${holiday}\n*Подпись* - ${caption}`;
    const htmlText = `<b>Дата</b> - ${date}<br><b>Праздник</b> - ${holiday}<br><b>Подпись</b> - ${caption}`;

    if (navigator.clipboard && window.isSecureContext) {
        const blobHTML = new Blob([htmlText], { type: "text/html" });
        const blobText = new Blob([plainText], { type: "text/plain" });
        const data = [new ClipboardItem({
            "text/html": blobHTML,
            "text/plain": blobText
        })];
        
        navigator.clipboard.write(data).then(() => {
            showSuccess(row);
        }).catch(err => {
            fallbackCopy(plainText, row);
        });
    } else {
        fallbackCopy(plainText, row);
    }
}

function fallbackCopy(text, row) {
    const t = document.createElement("textarea");
    t.value = text;
    document.body.appendChild(t);
    t.select();
    document.execCommand('copy');
    document.body.removeChild(t);
    showSuccess(row);
}

function showSuccess(row) {
    const btn = row.querySelector('.btn-green');
    const originalText = btn.innerText;
    btn.innerText = 'ГОТОВО';
    btn.style.background = '#155724';
    setTimeout(() => {
        btn.innerText = originalText;
        btn.style.background = '#28a745';
    }, 1000);
}
</script>

</body>
</html>