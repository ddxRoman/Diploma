<?php
require_once "../../action/connect.php";

$streets = array_unique(array_column($ventra_street, 'street'));
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <title>Дома</title>
</head>

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
