<?php
require_once "../../action/connect.php";

$street = $_GET['street'] ?? $_POST['street'] ?? null;
$build  = $_GET['build'] ?? $_POST['build'] ?? null;

if (!$street || !$build) {
    die("Ошибка: не переданы параметры street или build");
}

$sql = "SELECT id FROM ventra_home WHERE street = ? AND build = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Ошибка: адрес не найден в базе данных");
}

$adress_id = $row['id'];

// Заметки по дому
$ventra_note_current = mysqli_query($connect, "SELECT * FROM `ventra_home_notefication` WHERE `adress_id`=$adress_id");
$ventra_note_current = mysqli_fetch_all($ventra_note_current);

// История визитов
$ventra_visits = mysqli_query($connect, "SELECT * FROM `visit_home_date` WHERE `adress_id`=$adress_id ORDER BY `visit_date` DESC");
$ventra_visits = mysqli_fetch_all($ventra_visits);

// Комментарии
$ventra_builds_comment = mysqli_query($connect, "SELECT * FROM `ventra_builds_comment` WHERE `adress_id`=$adress_id ORDER BY `date` DESC");
$ventra_builds_comment = mysqli_fetch_all($ventra_builds_comment);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($street) ?> №<?= htmlspecialchars($build) ?></title>

          <link rel="stylesheet" type="text/css" href="../../css/ventra/ventra_current_home.css">
  <style>

  </style>
</head>

<body>
<div class="all_page_ventra">

  <header>
    <a href="home.php">
      <button class="btn_add_comments">🏠 На главную</button>
    </a>

    <h2><?= htmlspecialchars($street) ?> №<?= htmlspecialchars($build) ?> 
      <a href="note_home.php?street=<?=urlencode($street)?>&build=<?=urlencode($build)?>">
        <img src="../../file/icons/ventra/note.png" alt="note">
      </a>
    </h2>
  </header>

  <!-- 🔹 Информация по дому -->
  <section>
    <h3>Информация по дому</h3>
    <?php if (empty($ventra_note_current)): ?>
      <p style="color:#777;">Нет заметок для этого дома.</p>
    <?php else: ?>
      <?php foreach($ventra_note_current as $ventra_note_currents): ?>
        <table>
          <tr><td>Ключи:</td><td><?= htmlspecialchars($ventra_note_currents[3]) ?></td></tr>
          <tr><td>Конкуренты:</td><td><?= htmlspecialchars($ventra_note_currents[4]) ?></td></tr>
          <tr><td>Заметка:</td><td><?= htmlspecialchars($ventra_note_currents[2]) ?></td></tr>
        </table>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

  <!-- 🔹 История визитов -->
<!-- 🔹 История визитов -->
<section class="visit-section">
  <h3>История визитов</h3>
  <?php if (empty($ventra_visits)): ?>
    <p class="no-visits">Пока нет визитов.</p>
  <?php else: ?>
    <ul class="visit-list">
      <?php foreach($ventra_visits as $visit): ?>
        <li>
          <?= date('d.m.Y', strtotime($visit[2])) ?>
          <button 
            class="delete-visit-btn" 
            onclick="confirmDeleteVisit(<?= $visit[0] ?>, <?= $adress_id ?>)"
            title="Удалить визит"
          >🗑️</button>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form method="post" action="../../action/ventra/add_visit.php?id=<?= $adress_id ?>">
    <label for="visit_date">Дата визита:</label><br>
    <input type="date" id="visit_date" name="visit_date" required value="<?= date('Y-m-d') ?>">
    <button type="submit" class="btn_add_comments" style="margin-top:10px;">Добавить визит</button>
  </form>
</section>

<script>
function confirmDeleteVisit(visitId, adressId) {
  if (confirm("Вы уверены, что хотите удалить этот визит?")) {
    window.location.href = "../../action/ventra/delete_visit.php?id=" + visitId + "&adress_id=" + adressId ;
  }
}
</script>


  <!-- 🔹 Комментарии -->
  <section>
    <h3>Добавить комментарий</h3>
    <form class="ventra" method="post" action="../../action/ventra/add_comments.php?street=<?=urlencode($street)?>&build=<?=urlencode($build)?>">
      <textarea required name="comment" placeholder="Введите комментарий..."></textarea><br>
      <button class="btn_add_comments" type="submit">Добавить</button>
    </form>

    <hr>
    <h3>Комментарии</h3>
    <?php if (empty($ventra_builds_comment)): ?>
      <p style="color:#777;">Комментариев пока нет.</p>
    <?php else: ?>
      <?php foreach($ventra_builds_comment as $ventra_builds_comments): ?>
        <div class="comments_block">
          <p><?= htmlspecialchars($ventra_builds_comments[3]) ?></p>
          <p><?= htmlspecialchars($ventra_builds_comments[1]) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

</div>
</body>
</html>
