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
LIMIT 20
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
<style>

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
  <h2 class="page__title">Последние 20 визитов</h2>

  <div class="table-wrapper">
    <table class="table">
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
              <td data-label="Улица">
                <a href="<?= $url ?>" class="table__link"><?= $street ?></a>
              </td>
              <td data-label="Дом">
                <a href="<?= $url ?>" class="table__link"><?= $build ?></a>
              </td>
              <td data-label="Дата"><?= $visit_date ?></td>
              <td data-label="Дорхендеры" class="icon">
                <?= $row['dorhenders'] == 1 ? '<span class="icon--ok">✅</span>' : '<span class="icon--none">—</span>' ?>
              </td>
              <td data-label="Листовки" class="icon">
                <?= $row['listovki'] == 1 ? '<span class="icon--ok">✅</span>' : '<span class="icon--none">—</span>' ?>
              </td>
              <td data-label="Почтовые ящики" class="icon">
                <?= $row['pochtovye_yashiki'] == 1 ? '<span class="icon--ok">✅</span>' : '<span class="icon--none">—</span>' ?>
              </td>
              <td data-label="Комментарий"><?= nl2br(htmlspecialchars($row['comment'] ?? '')) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
