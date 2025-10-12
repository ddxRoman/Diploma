<?php
require_once "../../action/connect.php";

// Получаем уникальные улицы из базы
$streets_query = mysqli_query($connect, "SELECT DISTINCT `street` FROM `ventra_home` ORDER BY `street` ASC");
$streets = mysqli_fetch_all($streets_query, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Дома</title>
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
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
    }

    h1 {
      text-align: center;
      color: #222;
      margin-top: 10px;
      font-size: 24px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
      width: 100%;
      max-width: 500px;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: all 0.2s ease;
    }

    form:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    label {
      font-weight: 600;
      margin-bottom: 3px;
      color: #444;
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
    select:focus {
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
      transition: background 0.2s ease, transform 0.1s ease;
    }

    button:hover {
      background: #0056d8;
      transform: translateY(-1px);
    }

    hr {
      border: none;
      height: 1px;
      background: #ddd;
      width: 100%;
      max-width: 500px;
      margin: 10px auto;
    }

    @media (max-width: 600px) {
      form {
        padding: 18px;
      }

      input,
      select,
      button {
        font-size: 15px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <h1>Добавление и выбор дома</h1>

  <!-- Форма добавления -->
  <form action="../../action/ventra/add_home.php" method="post">
    <label for="street">Улица:</label>
     <!-- Select по умолчанию -->
    <select id="street_select" name="street" required>
      <option value="">Выберите улицу</option>
      <?php foreach ($streets as $row): ?>
        <option value="<?= htmlspecialchars($row['street'], ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($row['street']) ?>
        </option>
      <?php endforeach; ?>
      <option value="__new__">➕ Добавить новую улицу</option>
    </select>


    <label for="build">Дом:</label>
    <input type="text" id="build" name="build" placeholder="Введите номер дома" required>

    <button type="submit">Добавить</button>
  </form>

  <hr>

  <!-- Форма выбора -->
  <form method="get" action="current_home.php">
    <label for="street_select">Выберите улицу:</label>
    <select name="street" id="street_select" required>
      <option value="">Выберите улицу</option>
      <?php foreach ($streets as $row): ?>
        <option value="<?= htmlspecialchars($row['street'], ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($row['street']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="build_select">Выберите дом:</label>
    <select name="build" id="build_select" required>
      <option value="">Сначала выберите улицу</option>
    </select>

    <button type="submit">Найти</button>
  </form>

  <script>
    // Загрузка домов по выбранной улице
    document.getElementById('street_select').addEventListener('change', function () {
      const street = this.value;
      const buildselect = document.getElementById('build_select');

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
