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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Дома</title>
  <style>
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
    }
    input, select, button {
      padding: 12px 14px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background: #007bff;
      color: white;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: background 0.2s ease;
    }
    button:hover { background: #0056d8; }

    /* Toast уведомление */
    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      background: white;
      color: #333;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      padding: 12px 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      z-index: 9999;
      opacity: 0;
      transform: translateY(-10px);
      transition: opacity .3s, transform .3s;
    }
    .toast.show {
      opacity: 1;
      transform: translateY(0);
    }
    .toast.success { border-left: 5px solid #4CAF50; }
    .toast.error { border-left: 5px solid #f44336; }
    .toast.exists { border-left: 5px solid #ff9800; }

    hr {
      width: 100%;
      max-width: 500px;
      border: none;
      height: 1px;
      background: #ddd;
      margin: 20px 0;
    }
  </style>
</head>
<body>

<h1>Добавление и поиск дома</h1>

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

      // если добавили новую улицу — добавить в список поиска
      const newStreet = formData.get("street");
      const exists = [...document.querySelectorAll("#street_search option")]
        .some(opt => opt.value === newStreet);
      if (!exists) {
        const opt1 = document.createElement("option");
        opt1.value = newStreet;
        opt1.textContent = newStreet;
        document.getElementById("street_search").appendChild(opt1);

        const opt2 = document.createElement("option");
        opt2.value = newStreet;
        opt2.textContent = newStreet;
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
