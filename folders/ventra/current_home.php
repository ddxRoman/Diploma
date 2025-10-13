<?php
require_once "../../action/connect.php";

if(!$GET){
  $street = $_POST['street'];
  $build = $_POST['build'];
}

$street = $_GET['street'];
$build = $_GET['build'];

$sql = "SELECT id FROM ventra_home WHERE street = ? AND build = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
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
  <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <style>
    body {
      font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background-color: #f5f6fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .all_page_ventra {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      border-radius: 16px;
      box-shadow: 0 5px 18px rgba(0,0,0,0.08);
      padding: 25px 20px 40px;
      min-height: 100vh;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    h2 {
      font-size: 22px;
      margin: 0;
      color: #222;
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    h2 img {
      width: 22px;
      vertical-align: middle;
    }

    .btn_add_comments {
      background: #007bff;
      color: white;
      border: none;
      padding: 10px 16px;
      font-size: 15px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 2px 6px rgba(0, 123, 255, 0.25);
    }

    .btn_add_comments:hover {
      background: #0056d8;
      transform: translateY(-1px);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 15px;
      font-size: 15px;
    }

    td {
      padding: 6px 8px;
      vertical-align: top;
      word-break: break-word;
    }

    td:first-child {
      font-weight: 600;
      color: #555;
      width: 120px;
    }

    textarea, input[type="date"] {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      font-family: inherit;
      font-size: 15px;
      transition: all 0.2s ease;
      box-sizing: border-box;
    }

    textarea:focus, input[type="date"]:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
      outline: none;
    }

    form {
      margin-bottom: 20px;
    }

    .comments_block {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 12px 15px;
      margin-bottom: 12px;
      border-left: 5px solid #007bff;
    }

    hr {
      border: none;
      height: 1px;
      background: #ddd;
      margin: 25px 0;
    }

    h3 {
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    /* --- Новый блок истории визитов --- */
    .visit-section {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      padding: 15px 18px;
      margin-bottom: 25px;
    }

    .visit-section ul {
      list-style: none;
      padding: 0;
      margin: 10px 0 15px;
    }

    .visit-section li {
      background: #eef6ff;
      border-left: 4px solid #007bff;
      margin-bottom: 8px;
      padding: 8px 12px;
      border-radius: 6px;
      font-weight: 500;
      color: #333;
    }

    .no-visits {
      color: #777;
      font-style: italic;
    }

    @media (max-width: 768px) {
      .all_page_ventra {
        margin: 0 10px;
        padding: 20px 15px 50px;
        border-radius: 0;
        box-shadow: none;
      }

      header {
        flex-direction: column;
        align-items: stretch;
      }

      .btn_add_comments {
        width: 100%;
        font-size: 16px;
        padding: 12px;
      }
    }
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
  <section class="visit-section">
    <h3>История визитов</h3>
    <?php if (empty($ventra_visits)): ?>
      <p class="no-visits">Пока нет визитов.</p>
    <?php else: ?>
      <ul>
        <?php foreach($ventra_visits as $visit): ?>
          <li><?= date('d.m.Y', strtotime($visit[2])) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="post" action="../../action/ventra/add_visit.php?id=<?= $adress_id ?>">
      <label for="visit_date">Дата визита:</label><br>
      <input type="date" id="visit_date" name="visit_date" required value="<?= date('Y-m-d') ?>">
      <button type="submit" class="btn_add_comments" style="margin-top:10px;">Добавить визит</button>
    </form>
  </section>

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
