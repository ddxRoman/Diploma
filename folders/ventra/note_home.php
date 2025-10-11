<?php

$street = $_GET['street'];
$build = $_GET['build'];


?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <title>Форма конкурентов</title>
<?php
require_once "../../action/connect.php";

$streets = array_unique(array_column($ventra_street, 'street'));
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Дома</title>
  <style>
    body {
      font-family: system-ui, sans-serif;
      margin: 0;
      padding: 1rem;
      background: #f7f8fa;
      color: #222;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    form {
      width: 100%;
      max-width: 480px;
      background: #fff;
      padding: 1.5rem;
      margin-bottom: 1rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 0.75rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
    }

    button {
      padding: 0.75rem;
      background: #007bff;
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.2s;
    }

    button:hover {
      background: #0056b3;
    }

    hr {
      border: none;
      border-top: 1px solid #ddd;
      width: 100%;
      max-width: 480px;
      margin: 1rem 0;
    }

    @media (max-width: 480px) {
      body {
        padding: 0.5rem;
      }
      form {
        padding: 1rem;
      }
      button {
        font-size: 0.95rem;
      }
    }
  </style>
</head>

<body>

  <script>
    document.getElementById('street').addEventListener('change', function () {
      const street = this.value;
      const buildselect = document.getElementById('build');

      if (!street) {
        buildselect.innerHTML = '<option value="">Сначала выберите улицу</option>';
        return;
      }

      buildselect.innerHTML = '<option>Загрузка...</option>';

      fetch('get_build.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
        body: 'street=' + encodeURIComponent(street)
      })
      .then(response => {
        if (!response.ok) throw new Error('HTTP error ' + response.status);
        return response.json();
      })
      .then(data => {
        buildselect.innerHTML = '';
        if (!Array.isArray(data) || data.length === 0) {
          buildselect.innerHTML = '<option value="">Дома не найдены</option>';
          return;
        }
        data.forEach(build => {
          const opt = document.createElement('option');
          opt.value = build;
          opt.textContent = build;
          buildselect.appendChild(opt);
        });
      })
      .catch(err => {
        console.error('Fetch error:', err);
        buildselect.innerHTML = '<option value="">Ошибка загрузки</option>';
      });
    });
  </script>

</body>
</html>

</head>
<body>

  <form action="../../action/ventra/add_note_home.php?street=<?=$street?>&build=<?=$build?>" method="post">
    <label>Выбери конкурентов</label>
    <div class="checkbox-group">
      <label class="checkbox-item">
        <input type="checkbox" name="competitors[]" hidden value="mts">
        <img src="../../file/icons/ventra/mts.png" alt="МТС">
      </label>

      <label class="checkbox-item">
        <input type="checkbox" name="competitors[]" hidden value="rostelecom">
        <img src="../../file/icons/ventra/rostelecom.png" alt="Ростелеком">
      </label>

      <label class="checkbox-item">
        <input type="checkbox" name="competitors[]" hidden value="other">
        <img src="../../file/icons/ventra/other.png" alt="Другой">
      </label>
    </div>

    <div>
      <label for="keys">Подходят ли ключи (можно выбрать несколько)</label>
      <select name="keys[]" id="keys" multiple required>
        <option value="везде">Везде</option>
        <option value="почти-везде">Почти везде</option>
        <option value="почти-нигде">Почти нигде</option>
        <option value="нигде">Нигде</option>
      </select>
    </div>

    <div>
      <label for="note">Примечание</label>
      <textarea id="note" name="note" rows="4" placeholder="Введите заметку..."></textarea>
    </div>

    <button type="submit">Сохранить</button>
  </form>

</body>
</html>
