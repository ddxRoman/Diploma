<?php
require_once "../../action/connect.php";

// Получаем все улицы и дома
$streets_query = mysqli_query($connect, "SELECT DISTINCT `street` FROM `ventra_home` ORDER BY `street` ASC");
$streets = mysqli_fetch_all($streets_query, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Настройки Ventra</title>
<link rel="stylesheet" href="../../css/ventra-style.css">
<style>
body {
  font-family: sans-serif;
  background: #f7f7f7;
  margin: 0;
  padding: 0;
}

/* 🔝 Навбар */
.nav-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  background: #333;
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
.settings-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: white;
  font-size: 22px;
  text-decoration: none;
  transition: transform 0.2s, opacity 0.2s;
}
.settings-icon:hover {
  transform: translateY(-50%) rotate(45deg);
  opacity: 0.8;
}

/* 📋 Список улиц */
.street-block {
  background: white;
  margin: 10px auto;
  width: 95%;
  border-radius: 8px;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
  overflow: hidden;
}
.street-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px;
  background: #f0f0f0;
  cursor: pointer;
  font-weight: bold;
  flex-wrap: nowrap; /* ❗ запрещаем перенос */
  gap: 10px;
}
.street-header span {
  flex: 1;
  text-overflow: ellipsis; /* ❗ добавлять "..." */
}
.street-actions {
  display: flex;
  flex-shrink: 0;
  gap: 6px;
}

.street-actions button {
  flex-shrink: 0;
  margin: 0;
  border: none;
  border-radius: 5px;
  padding: 4px 8px;
  cursor: pointer;
  font-size: 14px;
}
.edit-btn {
  background: #3498db;
  color: white;
}
.delete-btn {
  background: #e74c3c;
  color: white;
}
.homes-list {
  display: none;
  padding: 10px;
}
.home-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 6px 10px;
  border-bottom: 1px solid #eee;
}
.home-item:last-child {
  border-bottom: none;
}

/* ⚠️ Попап */
.popup-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.6);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 10;
}
.popup {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  width: 90%;
  max-width: 400px;
  text-align: center;
}
.popup h3 {
  margin-top: 0;
}
.popup p {
  margin: 15px 0;
}
.popup button {
  margin: 5px;
  padding: 8px 14px;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
}
.popup .confirm {
  background: #e74c3c;
  color: white;
}
.popup .cancel {
  background: #ddd;
}

/* 📱 Мобильная адаптация */
@media (max-width: 600px) {
  .street-header { font-size: 14px; padding: 10px; }
  .home-item { font-size: 14px; }
  .street-actions button { font-size: 12px; padding: 3px 6px; }
}
/* Модальное окно */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
}

.modal.show {
  display: flex;
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 0 20px rgba(0,0,0,0.3);
  text-align: center;
}

.modal-content input {
  width: 100%;
  padding: 8px 10px;
  font-size: 16px;
  margin: 15px 0;
  border-radius: 8px;
  border: 1px solid #ccc;
}

.modal-buttons {
  display: flex;
  justify-content: space-between;
  gap: 10px;
}

.btn {
  flex: 1;
  padding: 8px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 15px;
  border: none;
}

.btn-save {
  background: #2b8a3e;
  color: white;
}

.btn-cancel {
  background: #e03131;
  color: white;
}

/* --- Всплывающие уведомления (toast) --- */
.toast-container {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.toast {
  background-color: #333;
  color: #fff;
  padding: 12px 18px;
  border-radius: 8px;
  min-width: 220px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  font-size: 15px;
  opacity: 0;
  transform: translateX(100%);
  transition: all 0.4s ease;
}

.toast.show {
  opacity: 1;
  transform: translateX(0);
}

.toast.success {
  background-color: #4CAF50;
}

.toast.error {
  background-color: #F44336;
}


</style>
</head>
<body>

<!-- Навбар -->
<nav class="nav-bar">
  <a href="../../folders/ventra/home.php" class="settings-icon" title="Главная">🏠</a>
  <span style="color:white;font-weight:bold;">Настройки</span>
</nav>

<h3 style="text-align:center;margin:15px;">Улицы и дома</h3>

<!-- 📋 Список улиц -->
<div id="streets-container">
  <?php foreach ($streets as $row): 
    $street = htmlspecialchars($row['street']);
    $homes_query = mysqli_query($connect, "SELECT id, build FROM ventra_home WHERE street='$street' ORDER BY build ASC");
    $homes = mysqli_fetch_all($homes_query, MYSQLI_ASSOC);
  ?>
    <div class="street-block">
      <div class="street-header" data-street="<?= $street ?>">
        <span><?= $street ?></span>
        <div class="street-actions">
<button class="btn-edit" data-type="street" data-name="<?= $street ?>">✏️</button>

  <button class="delete-btn" data-type="street" data-value="<?= $street ?>">🗑️</button>
        </div>
      </div>
      <div class="homes-list">
        <?php if (empty($homes)): ?>
          <div style="padding:10px;color:#777;">Нет домов</div>
        <?php else: ?>
          <?php foreach ($homes as $home): ?>
            <div class="home-item">
              <span><?= htmlspecialchars($home['build']) ?></span>
              <div>
<button class="btn-edit" data-type="home" data-id="<?= $home['id'] ?>" data-name="<?= htmlspecialchars($home['build']) ?>">✏️</button>
               <button class="delete-btn" data-type="home" data-id="<?= $home['id'] ?>">🗑️</button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- ⚠️ Попап подтверждения -->
<div class="popup-overlay" id="popup">
  <div class="popup">
    <h3 id="popupTitle">Подтверждение удаления</h3>
    <p id="popupText"></p>
    <button class="confirm" id="confirmDelete">Удалить</button>
    <button class="cancel" id="cancelDelete">Отмена</button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // === TOAST Уведомления ===
  const toastContainer = document.createElement("div");
  toastContainer.className = "toast-container";
  document.body.appendChild(toastContainer);

  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;
    toastContainer.appendChild(toast);
    setTimeout(() => toast.classList.add("show"), 100);
    setTimeout(() => {
      toast.classList.remove("show");
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  // раскрытие списка домов
  document.querySelectorAll(".street-header").forEach(header => {
    header.addEventListener("click", e => {
      if (e.target.closest("button")) return;
      const list = header.nextElementSibling;
      list.style.display = list.style.display === "block" ? "none" : "block";
    });
  });

  // ======= УДАЛЕНИЕ =======
  let deleteType = null, deleteValue = null, deleteId = null;
  const popup = document.getElementById("popup");
  const titleEl = document.getElementById("popupTitle");
  const textEl = document.getElementById("popupText");

  function openDeletePopup(type, value, id) {
    deleteType = type; deleteValue = value; deleteId = id;
    if (deleteType === "street") {
      titleEl.textContent = "Удалить улицу?";
      textEl.textContent = `⚠️ При удалении улицы "${deleteValue}" все дома на ней также будут удалены!`;
    } else {
      titleEl.textContent = "Удалить дом?";
      textEl.textContent = "Вы уверены, что хотите удалить этот дом?";
    }
    popup.style.display = "flex";
  }

  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      const type = btn.dataset.type;
      const value = btn.dataset.value ?? null;
      const id = btn.dataset.id ?? null;
      openDeletePopup(type, value, id);
    });
  });

  document.getElementById("cancelDelete").addEventListener("click", () => {
    popup.style.display = "none";
  });

  document.getElementById("confirmDelete").addEventListener("click", async () => {
    let formData = new FormData();
    formData.append("type", deleteType);
    if (deleteType === "street") formData.append("street", deleteValue);
    else formData.append("id", deleteId);

    try {
      const res = await fetch("../../action/ventra/delete_item.php", {
        method: "POST",
        body: formData
      });
      const result = await res.json();
      if (result.status === "ok") {
        showToast("✅ Успешно удалено");
        location.reload();
      } else {
        showToast("❌ " + (result.message || "Не удалось удалить"), "error");
      }
    } catch (err) {
      showToast("❌ Ошибка соединения с сервером", "error");
      console.error(err);
    }
    popup.style.display = "none";
  });

  // ======= РЕДАКТИРОВАНИЕ =======

  // ======= РЕДАКТИРОВАНИЕ =======
let editType = null;
let editId = null;
let editElement = null;

function openEditModal(type, id, name, element) {
  editType = type;
  editId = id;
  editElement = element;
  document.getElementById("modalTitle").textContent =
    type === "street" ? "Редактировать улицу" : "Редактировать дом";
  const input = document.getElementById("editInput");
  input.value = name || "";
  document.getElementById("editModal").classList.add("show");
  input.focus();
}

document.querySelectorAll(".btn-edit").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();

    // определяем тип
    const isHome = btn.closest(".home-item");
    const type = isHome ? "home" : "street";
    const id = btn.dataset.id ? parseInt(btn.dataset.id) : 0;

    // для домов и улиц извлекаем правильное имя
    let name, element;
    if (isHome) {
      const span = btn.closest(".home-item").querySelector("span");
      name = span ? span.textContent.trim() : "";
      element = span;
    } else {
      const span = btn.closest(".street-header").querySelector("span");
      name = span ? span.textContent.trim() : "";
      element = span;
    }

    openEditModal(type, id, name, element);
  });
});

document.getElementById("cancelEdit").addEventListener("click", () => {
  document.getElementById("editModal").classList.remove("show");
  editType = editId = editElement = null;
});

document.getElementById("saveEdit").addEventListener("click", async () => {
  const newName = document.getElementById("editInput").value.trim();
  if (!newName) return showToast("Введите новое значение", "error");

  const formData = new FormData();
  formData.append("type", editType);
  formData.append("id", editId);
  formData.append("newName", newName);

  // добавляем старое имя, если редактируется улица
  if (editType === "street" && editElement) {
    formData.append("oldName", editElement.textContent.trim());
  }

  try {
    const res = await fetch("../../action/ventra/edit_item.php", {
      method: "POST",
      body: formData
    });
    const data = await res.json();

    if (data.status === "ok") {
      showToast("✅ Изменения сохранены");
      if (editElement) editElement.textContent = newName;
      document.getElementById("editModal").classList.remove("show");
      editType = editId = editElement = null;
    } else {
      showToast("❌ " + (data.message || "Ошибка сохранения"), "error");
    }
  } catch (e) {
    console.error(e);
    showToast("❌ Ошибка связи с сервером", "error");
  }
});


  const editModal = document.getElementById("editModal");
  if (editModal) {
    editModal.addEventListener("click", (e) => {
      if (e.target === editModal) editModal.classList.remove("show");
    });
  }
});
</script>



<!-- Модальное окно редактирования -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <h3 id="modalTitle">Редактирование</h3>
    <input type="text" id="editInput" placeholder="Введите новое значение">
    <label for="#away">Дом передан другому сотруднику</label>
    <input type="checkbox" id="away"> 
    <div class="modal-buttons">
      <button id="saveEdit" class="btn btn-save">💾 Сохранить</button>
      <button id="cancelEdit" class="btn btn-cancel">✖ Отмена</button>
    </div>
  </div>
</div>


</body>
</html>
