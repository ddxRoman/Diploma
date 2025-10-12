<?php
require_once "../../action/connect.php";

$streets = array_unique(array_column($ventra_street, 'street'));
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css"> -->
  <title>Дома</title>
</head>
<style>
        * {
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", sans-serif;
      background-color: #f5f6fa;
      margin: 0;
      padding: 15px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    input[type="text"],
    select,
    button {
      width: 100%;
      padding: 12px 14px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
      transition: all 0.2s ease;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    button {
      background: #007bff;
      color: white;
      font-weight: 600;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background: #0056d8;
    }

    hr {
      border: none;
      height: 1px;
      background: #ddd;
      margin: 25px auto;
      max-width: 500px;
    }

    @media (max-width: 600px) {
      form {
        padding: 15px;
        gap: 10px;
      }

      input,
      select,
      button {
        font-size: 15px;
        padding: 10px;
      }
    }
</style>
<body>

  <!-- Форма добавления -->
  <form class="ventra_add_home" action="../../action/ventra/add_home.php" method="post">
    <input type="text" name="street" placeholder="Улица" required>
    <input type="text" name="build" placeholder="Дом" required>
    <button type="submit">Добавить</button>
  </form>

  <hr>

  <!-- Форма выбора -->
  <form class="ventra" method="get" action="current_home.php">
    <select name="street" id="street" required>
      <option value="">Выберите улицу</option>
      <?php foreach ($ventra_street as $ventra_streets): ?>
        <option value="<?= htmlspecialchars($ventra_streets[1], ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($ventra_streets[1]) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <select name="build" id="build" required>
      <option value="">Сначала выберите улицу</option>
    </select>

    <button class="btn_add_comments" type="submit">Найти</button>
  </form>

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
