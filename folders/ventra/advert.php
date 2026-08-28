<?php
require_once "../../action/connect.php";

$advert_query = mysqli_query($connect, "SELECT `id`, `image`, `start_date`, `end_date`, `created_at` FROM `ventra_advert` ORDER BY `id` DESC");
$adverts = mysqli_fetch_all($advert_query, MYSQLI_ASSOC);

function format_ru_date($value)
{
    if (!$value) {
        return '';
    }
    $d = DateTime::createFromFormat('Y-m-d', $value);
    return $d ? $d->format('d.m.Y') : '';
}

function days_between($start, $end)
{
    if (!$start || !$end) {
        return null;
    }
    $d1 = DateTime::createFromFormat('Y-m-d', $start);
    $d2 = DateTime::createFromFormat('Y-m-d', $end);
    if (!$d1 || !$d2) {
        return null;
    }
    return (int)$d1->diff($d2)->days;
}

function ru_days_word($n)
{
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) {
        return 'дней';
    }
    if ($n1 > 1 && $n1 < 5) {
        return 'дня';
    }
    if ($n1 === 1) {
        return 'день';
    }
    return 'дней';
}
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Админка рекламы</title>
<link rel="stylesheet" href="../../css/ventra-style.css">
<style>
/* display:block переопределяет глобальный body{display:flex;...} из ventra-style.css,
   который схлопывает ширину всех дочерних блоков (в т.ч. .page-wrap и .advert-grid) */
body { display: block; font-family: sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
.nav-bar { display: flex; align-items: center; justify-content: center; gap: 15px; background: #333; padding: 10px; position: relative; }
.settings-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: white; font-size: 22px; text-decoration: none; }

.page-wrap { max-width: 900px; width: 100%; margin: 0 auto; padding: 15px; box-sizing: border-box; }

.add-advert-btn {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  width: 100%; padding: 14px; margin-bottom: 15px;
  background: #2b8a3e; color: #fff; border: none; border-radius: 10px;
  font-size: 16px; font-weight: bold; cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.add-advert-btn:active { transform: translateY(1px); }

.advert-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 12px;
  height: 150px !important;
}
.advert-card1 {
  position: relative;
  background: #fff;
  border-radius: 10px;
  font-weight: 600;
  overflow: hidden;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
  width: 150px;
  height: 215px !important;
}
.advert-card1 img {
  border: 2px solid #ff00ea;
  width: 100%;
  height: 150px;
  object-fit: cover;
  display: block;
  cursor: pointer;
  background: #eee;
}
.advert-card1 .delete-btn {
  position: absolute;
  top: 6px;
  right: 6px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 4px 8px;
  cursor: pointer;
  font-size: 13px;
}
.advert-dates1 {
  padding: 6px 8px;
  font-size: 12px;
  color: #555;
  line-height: 1.5;
  background-color: #e7ab2a;
}
.advert-dates1 .no-dates { color: #aaa; }
.advert-empty {
  text-align: center;
  color: #888;
  padding: 40px 10px;
}

/* Модальное окно загрузки */
.modal { display: none; position: fixed; z-index: 1000; inset: 0; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
.modal.show { display: flex; }
.modal-content { background: #fff; padding: 20px; border-radius: 15px; width: 90%; max-width: 380px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
.modal-buttons { display: flex; gap: 10px; margin-top: 15px; }
.btn { flex: 1; padding: 12px; border-radius: 8px; cursor: pointer; border: none; font-weight: bold; font-size: 15px; }
.btn-save { background: #2b8a3e; color: white; }
.btn-cancel { background: #eee; color: #333; }
.btn-save:disabled { opacity: 0.6; cursor: not-allowed; }

.upload-drop {
  display: block;
  border: 2px dashed #ccc;
  border-radius: 10px;
  padding: 18px;
  cursor: pointer;
  color: #777;
}
.upload-drop img { max-width: 100%; max-height: 220px; border-radius: 8px; margin-top: 10px; }

.date-fields { margin-top: 15px; text-align: left; }
.date-field { margin-bottom: 10px; }
.date-field label { display: block; font-size: 13px; color: #555; margin-bottom: 4px; font-weight: 600; }
.date-field input[type="date"] { width: 100%; padding: 10px; font-size: 15px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; }

/* Просмотр фото на весь экран */
.viewer { display: none; position: fixed; z-index: 2000; inset: 0; background: rgba(0,0,0,0.85); justify-content: center; align-items: center; }
.viewer.show { display: flex; }
.viewer img { max-width: 92%; max-height: 88%; border-radius: 8px; }
.viewer-close { position: absolute; top: 15px; right: 20px; color: #fff; font-size: 28px; cursor: pointer; }

.toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
.toast { background: #333; color: #fff; padding: 12px 18px; border-radius: 8px; opacity: 0; transform: translateX(100%); transition: 0.4s; }
.toast.show { opacity: 1; transform: translateX(0); }
.toast.success { background: #4CAF50; }
.toast.error { background: #F44336; }
</style>
</head>
<body>

<nav class="nav-bar">
  <a href="../../action/ventra/ventra_settings.php" class="settings-icon">←</a>
  <span style="color:white;font-weight:bold;">Админка рекламы</span>
</nav>

<div class="page-wrap">
  <button class="add-advert-btn" id="openAddAdvert">➕ Добавить рекламу</button>

  <div class="advert-grid" id="advertGrid">
    <?php if (empty($adverts)): ?> 
      <div class="advert-empty" id="advertEmpty">Рекламы пока нет</div>
    <?php else: ?>
      <?php foreach ($adverts as $advert):
        $startFmt = format_ru_date($advert['start_date']);
        $endFmt = format_ru_date($advert['end_date']);
        $daysCount = days_between($advert['start_date'], $advert['end_date']);
      ?> 
        <div class="advert-card1" data-id="<?= (int)$advert['id'] ?>">
          <img src="<?= htmlspecialchars($advert['image']) ?>" alt="Реклама" class="advert-img">
          <button class="delete-btn" data-id="<?= (int)$advert['id'] ?>">🗑️</button>
          <div class="advert-dates1">
            <?php if ($startFmt || $endFmt): ?> 
              С: <?= $startFmt ?: '—' ?><br>По: <?= $endFmt ?: '—' ?>
              <?php if ($daysCount !== null): ?><br><?= $daysCount ?> <?= ru_days_word($daysCount) ?><?php endif; ?>
            <?php else: ?> 
              <span class="no-dates">Без ограничения по датам</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<div id="addModal" class="modal">
  <div class="modal-content">
    <h3>Новая реклама</h3>
    <label class="upload-drop" id="uploadDrop">
      <div id="uploadHint">Нажмите, чтобы выбрать фото</div>
      <img id="uploadPreview" style="display:none;">
      <input type="file" id="photoInput" accept="image/*" style="display:none;">
    </label>

    <div class="date-fields">
      <div class="date-field">
        <label for="startDate">Начало размещения (необязательно)</label>
        <input type="date" id="startDate">
      </div>
      <div class="date-field">
        <label for="endDate">Конец размещения (необязательно)</label>
        <input type="date" id="endDate">
      </div>
    </div>

    <div class="modal-buttons">
      <button id="saveAdvert" class="btn btn-save" disabled>💾 Загрузить</button>
      <button id="cancelAdvert" class="btn btn-cancel">Отмена</button>
    </div>
  </div>
</div>

<div class="viewer" id="viewer">
  <span class="viewer-close" id="viewerClose">✕</span>
  <img id="viewerImg" src="">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toastContainer = document.createElement("div");
  toastContainer.className = "toast-container";
  document.body.appendChild(toastContainer);

  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;
    toastContainer.appendChild(toast);
    setTimeout(() => toast.classList.add("show"), 100);
    setTimeout(() => { toast.classList.remove("show"); setTimeout(() => toast.remove(), 300); }, 3000);
  }

  function formatRu(isoDate) {
    if (!isoDate) return null;
    const [y, m, d] = isoDate.split('-');
    return `${d}.${m}.${y}`;
  }

  const grid = document.getElementById('advertGrid');
  const addModal = document.getElementById('addModal');
  const photoInput = document.getElementById('photoInput');
  const uploadPreview = document.getElementById('uploadPreview');
  const uploadHint = document.getElementById('uploadHint');
  const saveBtn = document.getElementById('saveAdvert');
  const startDateInput = document.getElementById('startDate');
  const endDateInput = document.getElementById('endDate');

  // Открыть модалку добавления
  document.getElementById('openAddAdvert').addEventListener('click', () => {
    photoInput.value = '';
    // По умолчанию подставляем сегодняшнюю дату как дату начала —
    // при желании администратор может её изменить.
    const now = new Date();
    const todayIso = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
    startDateInput.value = todayIso;
    endDateInput.value = '';
    uploadPreview.style.display = 'none';
    uploadHint.style.display = 'block';
    saveBtn.disabled = true;
    addModal.classList.add('show');
  });
  document.getElementById('cancelAdvert').addEventListener('click', () => addModal.classList.remove('show'));

  photoInput.addEventListener('change', () => {
    const file = photoInput.files[0];
    if (!file) { saveBtn.disabled = true; return; }
    uploadPreview.src = URL.createObjectURL(file);
    uploadPreview.style.display = 'block';
    uploadHint.style.display = 'none';
    saveBtn.disabled = false;
  });

  // Загрузка фото
  saveBtn.addEventListener('click', async () => {
    const file = photoInput.files[0];
    if (!file) return;

    saveBtn.disabled = true;
    saveBtn.textContent = 'Загрузка...';

    const fd = new FormData();
    fd.append('photo', file);
    fd.append('start_date', startDateInput.value);
    fd.append('end_date', endDateInput.value);

    try {
      const res = await fetch('../../action/ventra/add_advert.php', { method: 'POST', body: fd });
      const data = await res.json();

      if (data.status === 'ok') {
        addModal.classList.remove('show');
        showToast('✅ Реклама добавлена');
        // Перезагружаем страницу, чтобы у всех карточек (включая ту,
        // что только что автоматически закрылась) обновились даты.
        setTimeout(() => location.reload(), 500);
      } else {
        showToast('❌ ' + (data.message || 'Ошибка загрузки'), 'error');
      }
    } catch (e) {
      showToast('❌ Ошибка сервера', 'error');
    } finally {
      saveBtn.disabled = false;
      saveBtn.textContent = '💾 Загрузить';
    }
  });

  // Просмотр и удаление (делегирование событий, работает и для новых карточек)
  const viewer = document.getElementById('viewer');
  const viewerImg = document.getElementById('viewerImg');

  grid.addEventListener('click', async (e) => {
    const delBtn = e.target.closest('.delete-btn');
    if (delBtn) {
      if (!confirm('Удалить эту рекламу?')) return;
      const id = delBtn.dataset.id;
      const fd = new FormData();
      fd.append('id', id);
      try {
        const res = await fetch('../../action/ventra/delete_advert.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.status === 'ok') {
          delBtn.closest('.advert-card1').remove();
          if (!grid.querySelector('.advert-card1')) {
            grid.innerHTML = '<div class="advert-empty" id="advertEmpty">Рекламы пока нет</div>';
          }
          showToast('✅ Удалено');
        } else {
          showToast('❌ ' + (data.message || 'Ошибка удаления'), 'error');
        }
      } catch (err) {
        showToast('❌ Ошибка сервера', 'error');
      }
      return;
    }

    const img = e.target.closest('.advert-img');
    if (img) {
      viewerImg.src = img.src;
      viewer.classList.add('show');
    }
  });

  document.getElementById('viewerClose').addEventListener('click', () => viewer.classList.remove('show'));
  viewer.addEventListener('click', (e) => { if (e.target === viewer) viewer.classList.remove('show'); });
});
</script>
</body>
</html>
