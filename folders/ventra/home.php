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

</style>
</head>
<body>

<!-- 🔝 НАВИГАЦИЯ -->
<nav class="nav-bar">
  <a href="index.php" class="nav-bar__link nav-bar__link--active">Главная</a>
  <a href="visit_list.php" class="nav-bar__link">Визиты</a>
</nav>

<h2>Добавление дома</h2>

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
      showToast("✅ Дом успешно добавлен", "success");
      e.target.reset();
      input.style.display = "none";

      const newStreet = formData.get("street");
      const exists = [...document.querySelectorAll("#street_search option")]
        .some(opt => opt.value === newStreet);
      if (!exists) {
        const opt1 = new Option(newStreet, newStreet);
        const opt2 = new Option(newStreet, newStreet);
        document.getElementById("street_search").appendChild(opt1);
        document.getElementById("street_select").appendChild(opt2);
      }
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
