<?php
require_once "../../action/connect.php";

// Получаем список улиц
$streets_query = mysqli_query($connect, "SELECT DISTINCT `street` FROM `ventra_home` ORDER BY `street` ASC");
$streets = mysqli_fetch_all($streets_query, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../../css/ventra-style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Дома</title>
<style>

  body{
margin: 0%;
  padding: 0;
  }

/* 🔧 Стили навбара и иконки */
.nav-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  background: #007bff;
  padding: 10px;
  position: relative;
}

.nav-bar__link {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
  padding: 6px 10px;
  border-radius: 6px;
  transition: background 0.2s;
}

.nav-bar__link:hover {
  background: rgba(255, 255, 255, 0.1);
}

.nav-bar__link--active {
  background: rgba(255, 255, 255, 0.2);
}

/* Иконка шестерёнки слева */
.settings-icon {
  position: absolute;
  right: 10px;
  top: 50%;
  width: 8%;
  transform: translateY(-50%);
  color: white;
  font-size: 22px;
  text-decoration: none;
  transition: transform 0.2s, opacity 0.2s;
}

.settings-icon:hover {
  /* transform: translateY(-50%) rotate(45deg); */
  opacity: 0.8;
}

/* Мобильная адаптация */
@media (max-width: 600px) {
  .nav-bar {
    flex-wrap: wrap;
    gap: 10px;
    padding: 8px;
  }
  .settings-icon {
    font-size: 20px;
    left: 8px;
  }
  .nav-bar__link {
    font-size: 14px;
    padding: 5px 8px;
  }
}

/* ---------- Центрирование форм на странице ---------- */
.page, .content, main {
  display: flex;
  justify-content: center;  /* по горизонтали */
  align-items: center;      /* по вертикали */
  flex-direction: column;
  width: 100%;
  min-height: calc(100vh - 80px); /* чтобы форма была по центру видимой области */
  padding-top: 60px; /* чтобы не перекрывалось навигацией */
  box-sizing: border-box;
}

form {
  margin: 0 auto;
}

</style>
</head>
<body>

<!-- 🔝 НАВИГАЦИЯ -->
<nav class="nav-bar">
  <a href="../../action/ventra/ventra_settings.php" class="settings-icon" title="Настройки">⚙️</a>
  <a href="index.php" class="nav-bar__link nav-bar__link--active">Главная</a>
  <a href="visit_list.php" class="nav-bar__link">Визиты</a>
  <a href="warning_visits.php" class="nav-bar__link">Важные визиты</a>
   <a href="../../folders/ventra/advert.php" class="advert-admin-link" title="Админка рекламы">📢</a>
</nav>

<h2>Добавление дома</h2>
<div class="form_div_homepage">


<!-- ✅ Форма добавления -->
<form id="addHomeForm">
  <label for="street_select">Улица:</label>
  <select id="street_select" name="street_select" required>
    <option value="">Выберите улицу</option>
    <?php foreach ($streets as $row): ?>
      <option value="<?= htmlspecialchars($row['street']) ?>">
        <?= htmlspecialchars($row['street']) ?>
      </option>
    <?php endforeach; ?>
    <option value="__new__">➕ Добавить новую улицу</option>
  </select>

  <input type="text" id="street_input" name="street" placeholder="Введите новую улицу" style="display:none;">

  <label for="build">Дом:</label>
  <input type="text" id="build" name="build" placeholder="Введите номер дома" required>

  <button type="submit">Добавить</button>
</form>

<hr>

<h2>Поиск дома</h2>

<!-- 🔍 Форма поиска -->
<form id="searchForm" method="get" action="current_home.php">
  <label for="street_search">Выберите улицу:</label>
  <select id="street_search" name="street" required>
    <option value="">Выберите улицу</option>
    <?php foreach ($streets as $row): ?>
      <option value="<?= htmlspecialchars($row['street']) ?>">
        <?= htmlspecialchars($row['street']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="build_search">Выберите дом:</label>
  <select id="build_search" name="build" required>
    <option value="">Сначала выберите улицу</option>
  </select>

  <button type="submit">Найти</button>
</form>
</div>
<script>
// переключение поля "новая улица"
const select = document.getElementById("street_select");
const input = document.getElementById("street_input");

select.addEventListener("change", function() {
  if (this.value === "__new__") {
    input.style.display = "block";
    input.required = true;
    input.value = "";
    input.focus();
  } else {
    input.style.display = "none";
    input.required = false;
    input.value = this.value;
  }
});

// показ уведомления
function showToast(message, type = "success") {
  const toast = document.createElement("div");
  toast.className = `toast ${type}`;
  toast.textContent = message;
  document.body.appendChild(toast);
  setTimeout(() => toast.classList.add("show"), 100);
  setTimeout(() => {
    toast.classList.remove("show");
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// обработка формы добавления AJAX
document.getElementById("addHomeForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  formData.set("street", input.value || select.value);

  try {
    const res = await fetch("../../action/ventra/add_home.php", {
      method: "POST",
      body: formData
    });
    const result = await res.json();

    if (result.status === "ok") {
      // получаем значения, которые были отправлены
      const newStreet = formData.get("street") || '';
      const newBuild = formData.get("build") || '';

      // если нет номера дома — показываем ошибку
      if (!newBuild) {
        showToast('❌ Укажите номер дома', 'error');
        return;
      }

      // редирект на страницу добавленного дома
      window.location.href = `current_home.php?street=${encodeURIComponent(newStreet)}&build=${encodeURIComponent(newBuild)}`;
      return;

    } else if (result.status === "exists") {
      showToast("⚠️ Такой дом уже существует", "exists");
    } else {
      showToast("❌ " + (result.message || "Ошибка сервера"), "error");
    }
  } catch (err) {
    showToast("❌ Ошибка соединения с сервером", "error");
    console.error(err);
  }
});

// подгрузка домов при выборе улицы в форме поиска
document.getElementById("street_search").addEventListener("change", function() {
  const street = this.value;
  const buildSelect = document.getElementById("build_search");

  if (!street) {
    buildSelect.innerHTML = '<option value="">Сначала выберите улицу</option>';
    return;
  }

  buildSelect.innerHTML = '<option>Загрузка...</option>';

  fetch('get_build.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
    body: 'street=' + encodeURIComponent(street)
  })
  .then(r => r.json())
  .then(data => {
    buildSelect.innerHTML = '';
    if (!data.length) {
      buildSelect.innerHTML = '<option value="">Дома не найдены</option>';
      return;
    }
    data.forEach(b => {
      const opt = document.createElement('option');
      opt.value = b;
      opt.textContent = b;
      buildSelect.appendChild(opt);
    });
  })
  .catch(() => {
    buildSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
  });
});
</script>

</body>
</html>
