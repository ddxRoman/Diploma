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

// Проверка на глобальную проблему
$global_problem = false;
$problem_message = '';

$check_problem = mysqli_query(
    $connect,
    "SELECT global_problem FROM `ventra_home_notefication` WHERE `adress_id` = $adress_id AND `global_problem` = 1 LIMIT 1"
);
if (mysqli_num_rows($check_problem) > 0) {
    $global_problem = true;
    $problem_message = "⚠️ На этом доме ГЛОБАЛЬНАЯ ПРОБЛЕМА!";
}



// История визитов
$ventra_visits = mysqli_query($connect, "SELECT * FROM `visit_home_date` WHERE `adress_id`=$adress_id ORDER BY `visit_date` DESC");
$ventra_visits = mysqli_fetch_all($ventra_visits);

// Комментарии
$ventra_builds_comment = mysqli_query($connect, "SELECT * FROM `ventra_builds_comment` WHERE `adress_id`=$adress_id ORDER BY `date` DESC");
$ventra_builds_comment = mysqli_fetch_all($ventra_builds_comment);

// Актуальная реклама, выбранная для этого дома
$current_promo = null;
$cur_promo_stmt = mysqli_prepare(
    $connect,
    "SELECT a.id, a.image FROM `ventra_home_advert` h JOIN `ventra_advert` a ON a.id = h.advert_id WHERE h.adress_id = ?"
);
mysqli_stmt_bind_param($cur_promo_stmt, "i", $adress_id);
mysqli_stmt_execute($cur_promo_stmt);
$current_promo = mysqli_stmt_get_result($cur_promo_stmt)->fetch_assoc();

// Вся загруженная реклама — для выбора в модалке
$all_promos_q = mysqli_query($connect, "SELECT id, image FROM `ventra_advert` ORDER BY id DESC");
$all_promos = mysqli_fetch_all($all_promos_q, MYSQLI_ASSOC);
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

<body <?= $global_problem ? 'class="global-problem"' : '' ?>>

<div class="all_page_ventra">

<?php if ($global_problem): ?>
  <div class="global-warning">
    <?= htmlspecialchars($problem_message) ?>
  </div>
<?php endif; ?>


  <header>
    <a href="home.php">
      <button class="btn_add_comments">🏠 На главную</button>
    </a>

    <h2><?= htmlspecialchars($street) ?> №<?= htmlspecialchars($build) ?> 
      <a href="note_home.php?street=<?=urlencode($street)?>&build=<?=urlencode($build)?>">
        <img src="../../file/icons/ventra/note.png" alt="note">
      </a>
        <a href="https://yandex.ru/maps/?text=Краснодар,<?=urlencode($street)?>+<?=urlencode($build)?>" target="_self"> 
        <img src="../../file/icons/ventra/maps.png" alt="note">
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
<!-- 🔹 История визитов -->
<section class="visit-section">
  <h3>История визитов</h3>
  <?php if (empty($ventra_visits)): ?>
    <p class="no-visits">Пока нет визитов.</p>
  <?php else: ?>
    <ul class="visit-list">
      <?php foreach($ventra_visits as $visit): 
        $visit_id = $visit[0];
        $visit_date = date('d.m.Y', strtotime($visit[2]));
        $dorhenders = $visit[3];
        $listovki = $visit[4];
        $pochtovye_yashiki = $visit[5];
        $comment = htmlspecialchars($visit[6] ?? '');
      ?>
        <li class="visit-item" onclick="toggleVisitDetails(<?= $visit_id ?>)">
          <div class="visit-header">
            <span><?= $visit_date ?></span>
            <button 
              class="delete-visit-btn" 
              onclick="event.stopPropagation(); confirmDeleteVisit(<?= $visit_id ?>, <?= $adress_id ?>)"
              title="Удалить визит"
            >🗑️</button>
          </div>
          <div class="visit-details" id="visit-details-<?= $visit_id ?>">
            <div><b>Дорхендеры:</b> <?= $dorhenders == 1 ? '✅' : '—' ?></div>
            <div><b>Листовки:</b> <?= $listovki == 1 ? '✅' : '—' ?></div>
            <div><b>Почтовые ящики:</b> <?= $pochtovye_yashiki == 1 ? '✅' : '—' ?></div>
            <?php if (!empty($comment)): ?>
              <div><b>Комментарий:</b> <?= nl2br($comment) ?></div>
            <?php endif; ?>
          </div>
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

  <!-- 🔹 Актуальная реклама -->
  <section class="promo-section">
    <h3>Актуальная реклама</h3>
    <div id="promoDisplay">
      <?php if ($current_promo): ?>
        <div class="promo-current">
          <img src="<?= htmlspecialchars($current_promo['image']) ?>" alt="Актуальная реклама" class="promo-current-img">
          <button class="promo-change-btn" id="openPromoPicker">🔄 Сменить</button>
        </div>
      <?php else: ?>
        <button class="promo-toggle-btn" id="openPromoPicker">🖼️ Актуальная реклама</button>
      <?php endif; ?>
    </div>
  </section>

  <div class="modal" id="promoPickerModal">
    <div class="modal-content promo-picker-content">
      <h3>Выберите рекламу</h3>
      <?php if (empty($all_promos)): ?>
        <p style="color:#888;">Загруженной рекламы пока нет. Загрузите её в разделе «Админка рекламы».</p>
      <?php else: ?>
        <div class="promo-picker-grid">
          <?php foreach ($all_promos as $promo): ?>
            <img
              src="<?= htmlspecialchars($promo['image']) ?>"
              class="promo-picker-item<?= ($current_promo && (int)$current_promo['id'] === (int)$promo['id']) ? ' selected' : '' ?>"
              data-id="<?= (int)$promo['id'] ?>"
              alt="Реклама"
            >
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <button class="btn btn-cancel" id="closePromoPicker">Отмена</button>
    </div>
  </div>

<script>
function toggleVisitDetails(id) {
  const el = document.getElementById("visit-details-" + id);
  el.classList.toggle("open");
}

function confirmDeleteVisit(visitId, adressId) {
  if (confirm("Вы уверены, что хотите удалить этот визит?")) {
    window.location.href = "../../action/ventra/delete_visit.php?id=" + visitId + "&adress_id=" + adressId ;
  }
}
</script>

<style>

/* 🔹 Если глобальная проблема */
body.global-problem {
  background-color: rgba(255, 0, 0, 0.08); /* лёгкий красный фон */
}

.global-warning {
  background: #ff4d4d;
  color: white;
  text-align: center;
  padding: 12px 8px;
  font-weight: bold;
  font-size: 18px;
  border-radius: 10px;
  margin: 10px 5px 15px 5px;
  box-shadow: 0 2px 8px rgba(255, 0, 0, 0.3);
  animation: pulse 1.5s infinite alternate;
}

@keyframes pulse {
  from { transform: scale(1); opacity: 0.9; }
  to { transform: scale(1.03); opacity: 1; }
}


.visit-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.visit-item {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 10px 14px;
  cursor: pointer;
  transition: background 0.2s ease;
}
.visit-item:hover {
  background: #f7f9ff;
}
.visit-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 600;
}
.visit-details {
  display: none;
  margin-top: 8px;
  padding-top: 8px;
  border-top: 1px solid #eee;
  color: #555;
  font-size: 14px;
  line-height: 1.4;
}
.visit-details.open {
  display: block;
  animation: fadeIn .2s ease;
}
.delete-visit-btn {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 18px;
}
@keyframes fadeIn {
  from {opacity: 0; transform: translateY(-3px);}
  to {opacity: 1; transform: translateY(0);}
}

/* 🔹 Мобильная адаптация */
@media (max-width: 700px) {
  .visit-item {
    padding: 12px;
    font-size: 15px;
  }
  .visit-header span {
    font-size: 16px;
  }
  .visit-details div {
    font-size: 14px;
  }
}
</style>


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
<script>
document.addEventListener('DOMContentLoaded', () => {
  const promoModal = document.getElementById('promoPickerModal');
  const openPromoBtn = document.getElementById('openPromoPicker');
  const closePromoBtn = document.getElementById('closePromoPicker');

  if (openPromoBtn) {
    openPromoBtn.addEventListener('click', () => promoModal.classList.add('show'));
  }
  if (closePromoBtn) {
    closePromoBtn.addEventListener('click', () => promoModal.classList.remove('show'));
  }
  promoModal.addEventListener('click', (e) => {
    if (e.target === promoModal) promoModal.classList.remove('show');
  });

  document.querySelectorAll('.promo-picker-item').forEach((img) => {
    img.addEventListener('click', async () => {
      const advertId = img.dataset.id;
      const fd = new FormData();
      fd.append('adress_id', '<?= (int)$adress_id ?>');
      fd.append('advert_id', advertId);

      try {
        const res = await fetch('../../action/ventra/set_home_advert.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.status === 'ok') {
          location.reload();
        } else {
          alert(data.message || 'Ошибка при выборе рекламы');
        }
      } catch (err) {
        alert('Ошибка сервера');
      }
    });
  });
});
</script>

<style>
.promo-section {
  background: #fff;
  border-radius: 10px;
  padding: 14px 16px;
  margin: 10px 5px 15px 5px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.promo-section h3 { margin: 0 0 10px 0; }

.promo-toggle-btn {
  width: 100%;
  padding: 14px;
  background: #2b8a3e;
  color: #fff;
  border: none;
  border-radius: 10px;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
}
.promo-toggle-btn:active { transform: translateY(1px); }

.promo-current {
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
}
.promo-current-img {
  width: 100%;
  max-height: 460px;
  object-fit: cover;
  border-radius: 10px;
  background: #eee;
}
.promo-change-btn {
  width: 100%;
  padding: 10px;
  background: #eef1f7;
  color: #333;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
}
.promo-change-btn:active { transform: translateY(1px); }

/* Модалка выбора рекламы */
.modal { display: none; position: fixed; z-index: 1000; inset: 0; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
.modal.show { display: flex; }
.modal-content { background: #fff; padding: 20px; border-radius: 15px; width: 90%; max-width: 420px; max-height: 85vh; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
.promo-picker-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
  gap: 10px;
  margin: 12px 0;
}
.promo-picker-item {
  width: 100%;
  height: 110px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  border: 3px solid transparent;
  background: #eee;
}
.promo-picker-item:hover { border-color: #2b8a3e; }
.promo-picker-item.selected { border-color: #2b8a3e; }
.btn { padding: 12px; border-radius: 8px; cursor: pointer; border: none; font-weight: bold; font-size: 15px; width: 100%; margin-top: 5px; }
.btn-cancel { background: #eee; color: #333; }
</style>

</body>
</html>
