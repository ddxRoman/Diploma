<?php
require_once "../../action/connect.php";

$query = "
SELECT 
  v.visit_date,
  v.dorhenders,
  v.listovki,
  v.pochtovye_yashiki,
  v.comment,
  h.street,
  h.build
FROM visit_home_date AS v
LEFT JOIN ventra_home AS h ON v.adress_id = h.id
ORDER BY v.visit_date DESC
LIMIT 100
";
$result = mysqli_query($connect, $query);
$visits = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Последние визиты</title>

<!-- ✅ Подключаем Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>

<style>
body {
  margin: 0;
  padding: 0;
}

/* 🔹 Контейнер фильтров */
.filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin: 20px auto;
  max-width: 800px;
}

/* 🔹 Поле поиска и даты */
.filters input {
  padding: 10px 14px;
  border: 2px solid #007bff;
  border-radius: 8px;
  font-size: 15px;
  outline: none;
  transition: 0.2s;
  cursor: pointer;
  width: 250px;
  background-color: #fff;
}
.filters input:focus {
  border-color: #0056b3;
  box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
}

/* 🔹 Прокручиваемая таблица */
.table-wrapper {
  max-height: 70vh;
  overflow-y: auto;
  border-radius: 10px;
  border: 1px solid #ddd;
}

/* 🔹 Фиксированный заголовок */
.table thead {
  position: sticky;
  top: 0;
  background: #007bff;
  color: white;
  z-index: 10;
}
.table th {
  padding: 10px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}
.table td {
  padding: 10px;
  border-bottom: 1px solid #eee;
}

/* 🔹 Адаптивность */
@media (max-width: 600px) {
  .filters { flex-direction: column; width: 90%; }
  .filters input { width: 90%; font-size: 14px; }
  .table-wrapper { max-height: 60vh; }
  .table th, .table td { font-size: 13px; }
}
</style>
</head>
<body>

<!-- 🔹 Навигация -->
<nav class="nav">
  <a href="home.php" class="nav__link">Главная</a>
  <a href="visit_list.php" class="nav__link nav__link--active">Визиты</a>
  <a href="warning_visits.php" class="nav__link">Важные визиты</a>
</nav>

<div class="page">

  <h2 class="page__title">Последние визиты</h2>

  <!-- 🔹 Фильтры -->
  <div class="filters">
    <input type="text" id="searchInput" placeholder="Поиск по улице или дому..." oninput="filterVisits()">
    <input type="text" id="dateRange" placeholder="Выберите дату или диапазон..." readonly>
  </div>

  <div class="table-wrapper">
    <table class="table" id="visitsTable">
      <thead>
        <tr class="table__head-row">
          <th>Улица</th>
          <th>Дом</th>
          <th>Дата</th>
          <th>Дорхендеры</th>
          <th>Листовки</th>
          <th>Почтовые ящики</th>
          <th>Комментарий</th>
        </tr>
      </thead>
      <tbody class="table__body">
        <?php if (empty($visits)): ?>
          <tr><td colspan="7" style="text-align:center;">Нет данных</td></tr>
        <?php else: ?>
          <?php foreach ($visits as $row): 
            $street = htmlspecialchars($row['street'] ?? '—');
            $build = htmlspecialchars($row['build'] ?? '—');
            $visit_date = htmlspecialchars($row['visit_date']);
            $url = "../ventra/current_home.php?street=" . urlencode($street) . "&build=" . urlencode($build);
          ?>
            <tr>
              <td data-label="Улица"><a href="<?= $url ?>" class="table__link"><?= $street ?></a></td>
              <td data-label="Дом"><a href="<?= $url ?>" class="table__link"><?= $build ?></a></td>
              <td data-label="Дата"><?= $visit_date ?></td>
              <td data-label="Дорхендеры"><?= $row['dorhenders'] ? '✅' : '—' ?></td>
              <td data-label="Листовки"><?= $row['listovki'] ? '✅' : '—' ?></td>
              <td data-label="Почтовые ящики"><?= $row['pochtovye_yashiki'] ? '✅' : '—' ?></td>
              <td data-label="Комментарий"><?= nl2br(htmlspecialchars($row['comment'] ?? '')) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
// ✅ Инициализация календаря Flatpickr
let selectedDates = [];
flatpickr("#dateRange", {
  mode: "range", // можно выбрать одну дату или диапазон
  dateFormat: "Y-m-d",
  locale: "ru",
  onChange: function(selected) {
    selectedDates = selected.map(d => d.toISOString().slice(0, 10));
    filterVisits();
  }
});

// 🔍 Фильтрация по тексту и диапазону дат
function filterVisits() {
  const searchValue = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('#visitsTable tbody tr');

  const fromDate = selectedDates[0] || null;
  const toDate = selectedDates[1] || selectedDates[0] || null;

  rows.forEach(row => {
    const street = row.cells[0]?.innerText.toLowerCase() || '';
    const build  = row.cells[1]?.innerText.toLowerCase() || '';
    const date   = row.cells[2]?.innerText.trim();

    const matchText = street.includes(searchValue) || build.includes(searchValue);

    let matchDate = true;
    if (fromDate && date < fromDate) matchDate = false;
    if (toDate && date > toDate) matchDate = false;

    row.style.display = (matchText && matchDate) ? '' : 'none';
  });
}
</script>

</body>
</html>
