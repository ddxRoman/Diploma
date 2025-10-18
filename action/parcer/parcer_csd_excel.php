<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// очищаем переменные
$resultText = '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Парсер MEDRWK / MEDSUP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            max-width: 700px;
            background: #f8f8f8;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 25px;
            text-align: center;
        }
        input[type="file"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            position: relative;
        }
        .copy-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #28a745;
        }
        .copy-btn:hover {
            background-color: #1e7e34;
        }
        pre {
            white-space: pre-wrap;
            word-break: break-word;
            font-size: 15px;
            line-height: 1.4;
        }
        #toast {
            visibility: hidden;
            min-width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 12px;
            position: fixed;
            z-index: 999;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            font-size: 16px;
        }
        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @keyframes fadein { from {bottom: 0; opacity: 0;} to {bottom: 30px; opacity: 1;} }
        @keyframes fadeout { from {bottom: 30px; opacity: 1;} to {bottom: 0; opacity: 0;} }
    </style>
</head>
<body>

<h1>Парсер Excel: MEDRWK / MEDSUP</h1>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="excelFile" accept=".xls,.xlsx" required>
    <button type="submit">Загрузить и распарсить</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excelFile'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
    $filePath = $uploadDir . basename($_FILES['excelFile']['name']);

    if (move_uploaded_file($_FILES['excelFile']['tmp_name'], $filePath)) {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            array_shift($rows);

            $medrwk = [];
            $medsup = [];

            foreach ($rows as $row) {
                $value = trim($row[0]);
                if ($value === '' || stripos($value, 'IT') !== false) continue;

                if (stripos($value, 'MEDRWK') === 0) {
                    $num = preg_replace('/\D/', '', $value);
                    if ($num !== '') $medrwk[] = (int)$num;
                } elseif (stripos($value, 'MEDSUP') === 0) {
                    $num = preg_replace('/\D/', '', $value);
                    if ($num !== '') $medsup[] = (int)$num;
                }
            }

            $medrwk = array_unique($medrwk);
            $medsup = array_unique($medsup);
            sort($medrwk);
            sort($medsup);

            $resultText = "MEDRWK - " . implode(', ', $medrwk) . "\n\n" .
                          "MEDSUP - " . implode(', ', $medsup);

            echo "<div class='result'>";
            echo "<button type='button' class='copy-btn' id='copyBtn'>📋 Копировать</button>";
            echo "<h3>Результат:</h3>";
            echo "<pre id='resultText'>" . htmlspecialchars($resultText) . "</pre>";
            echo "</div>";

        } catch (Exception $e) {
            echo "<p style='color:red;text-align:center;'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color:red;text-align:center;'>Не удалось загрузить файл.</p>";
    }
}
?>

<div id="toast">Результат скопирован!</div>

<script>
document.addEventListener("click", function(e) {
    if (e.target && e.target.id === "copyBtn") {
        const resultElement = document.getElementById("resultText");
        if (!resultElement) {
            console.error("Элемент с результатом не найден!");
            return;
        }

        const text = resultElement.innerText.trim();
        if (!text) {
            showToast("Нет данных для копирования!");
            return;
        }

        // Копируем надёжно (для старых браузеров тоже)
        const temp = document.createElement("textarea");
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);

        showToast("Результат скопирован!");
    }
});

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className = "show";
    setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
}
</script>

</body>
</html>
