<?php
require_once "../../action/connect.php";

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
body { font-family: sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
.nav-bar { display: flex; align-items: center; justify-content: center; gap: 15px; background: #333; padding: 10px; position: relative; }
.settings-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: white; font-size: 22px; text-decoration: none; }
.street-block { background: white; margin: 10px auto; width: 95%; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); overflow: hidden; }
.street-header { display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f0f0f0; cursor: pointer; font-weight: bold; gap: 10px; }
.btn-edit { background: #3498db; color: white; border: none; border-radius: 5px; padding: 4px 8px; cursor: pointer; }
.delete-btn { background: #e74c3c; color: white; border: none; border-radius: 5px; padding: 4px 8px; cursor: pointer; }
.homes-list { display: none; padding: 10px; }
.home-item { display: flex; justify-content: space-between; align-items: center; padding: 6px 10px; border-bottom: 1px solid #eee; }
.home-item.disabled span { color: #aaa; text-decoration: line-through; }

/* --- СТИЛИ ПЕРЕКЛЮЧАТЕЛЯ (TOGGLE) --- */
.switch-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f9f9f9;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    border: 1px solid #eee;
}
.switch-label { font-size: 14px; color: #555; font-weight: 600; }

.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
  position: absolute;
  cursor: pointer;
  inset: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider { background-color: #e03131; } /* Красный, когда "передан" */
input:checked + .slider:before { transform: translateX(24px); }

/* Модальное окно */
.modal { display: none; position: fixed; z-index: 1000; inset: 0; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
.modal.show { display: flex; }
.modal-content { background: #fff; padding: 20px; border-radius: 15px; width: 90%; max-width: 380px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
.modal-content input[type="text"] { width: 100%; padding: 12px; font-size: 16px; margin: 15px 0; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; }
.modal-buttons { display: flex; gap: 10px; }
.btn { flex: 1; padding: 12px; border-radius: 8px; cursor: pointer; border: none; font-weight: bold; font-size: 15px; }
.btn-save { background: #2b8a3e; color: white; }
.btn-cancel { background: #eee; color: #333; }

.toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
.toast { background: #333; color: #fff; padding: 12px 18px; border-radius: 8px; opacity: 0; transform: translateX(100%); transition: 0.4s; }
.toast.show { opacity: 1; transform: translateX(0); }
.toast.success { background: #4CAF50; }
.toast.error { background: #F44336; }
</style>
</head>
<body>

<nav class="nav-bar">
  <a href="../../folders/ventra/home.php" class="settings-icon">🏠</a>
  <span style="color:white;font-weight:bold;">Настройки</span>
</nav>

<div id="streets-container">
  <?php foreach ($streets as $row): 
    $street = htmlspecialchars($row['street']);
    $homes_query = mysqli_query($connect, "SELECT id, build, disable FROM ventra_home WHERE street='$street' ORDER BY build ASC");
    $homes = mysqli_fetch_all($homes_query, MYSQLI_ASSOC);
  ?>
    <div class="street-block">
      <div class="street-header">
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
            <div class="home-item <?= $home['disable'] ? 'disabled' : '' ?>">
              <span><?= htmlspecialchars($home['build']) ?></span>
              <div>
                <button class="btn-edit" data-type="home" data-id="<?= $home['id'] ?>" data-name="<?= htmlspecialchars($home['build']) ?>" data-disable="<?= $home['disable'] ?>">✏️</button>
                <button class="delete-btn" data-type="home" data-id="<?= $home['id'] ?>">🗑️</button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div id="editModal" class="modal">
  <div class="modal-content">
    <h3 id="modalTitle">Редактирование</h3>
    <input type="text" id="editInput" placeholder="Номер дома">
    
    <div class="switch-container" id="disableWrapper">
        <span class="switch-label">Передан другому / Архив</span>
        <label class="switch">
          <input type="checkbox" id="away">
          <span class="slider"></span>
        </label>
    </div>

    <div class="modal-buttons">
      <button id="saveEdit" class="btn btn-save">💾 Сохранить</button>
      <button id="cancelEdit" class="btn btn-cancel">Отмена</button>
    </div>
  </div>
</div>

<div class="popup-overlay" id="popup" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:2000; justify-content:center; align-items:center;">
  <div class="modal-content">
    <h3 id="popupTitle">Удаление</h3>
    <p id="popupText" style="margin-bottom:20px;"></p>
    <div class="modal-buttons">
        <button class="btn btn-save" id="confirmDelete" style="background:#e74c3c">Удалить</button>
        <button class="btn btn-cancel" id="cancelDelete">Отмена</button>
    </div>
  </div>
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

  document.querySelectorAll(".street-header").forEach(header => {
    header.addEventListener("click", e => {
      if (e.target.closest("button")) return;
      const list = header.nextElementSibling;
      list.style.display = list.style.display === "block" ? "none" : "block";
    });
  });

  let deleteType, deleteValue, deleteId;
  const popup = document.getElementById("popup");

  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      deleteType = btn.dataset.type;
      deleteValue = btn.dataset.value;
      deleteId = btn.dataset.id;
      document.getElementById("popupText").textContent = deleteType === "street" ? "Удалить улицу и все дома на ней?" : "Вы уверены, что хотите удалить этот дом?";
      popup.style.display = "flex";
    });
  });

  document.getElementById("confirmDelete").addEventListener("click", async () => {
    let fd = new FormData();
    fd.append("type", deleteType);
    deleteType === "street" ? fd.append("street", deleteValue) : fd.append("id", deleteId);
    const res = await fetch("../../action/ventra/delete_item.php", { method: "POST", body: fd });
    const data = await res.json();
    if (data.status === "ok") location.reload();
  });

  document.getElementById("cancelDelete").addEventListener("click", () => popup.style.display = "none");

  // РЕДАКТИРОВАНИЕ
  let editType, editId, editElement;

  function openEditModal(type, id, name, element, disable) {
    editType = type;
    editId = id;
    editElement = element;
    document.getElementById("modalTitle").textContent = type === "street" ? "Улица" : "Дом " + name;
    document.getElementById("editInput").value = name;
    
    const disableWrapper = document.getElementById("disableWrapper");
    if (type === "home") {
        disableWrapper.style.display = "flex";
        document.getElementById("away").checked = (parseInt(disable) === 1);
    } else {
        disableWrapper.style.display = "none";
    }
    document.getElementById("editModal").classList.add("show");
  }

  document.querySelectorAll(".btn-edit").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation();
      const type = btn.dataset.type;
      const id = btn.dataset.id;
      const name = btn.dataset.name;
      const disable = btn.dataset.disable || 0;
      const element = btn.closest(type === "home" ? ".home-item" : ".street-header").querySelector("span");
      openEditModal(type, id, name, element, disable);
    });
  });

  document.getElementById("saveEdit").addEventListener("click", async () => {
    const newName = document.getElementById("editInput").value.trim();
    const isDisable = document.getElementById("away").checked ? 1 : 0;
    
    const fd = new FormData();
    fd.append("type", editType);
    fd.append("id", editId);
    fd.append("newName", newName);
    fd.append("disable", isDisable);
    if (editType === "street") fd.append("oldName", editElement.textContent.trim());

    try {
      const res = await fetch("../../action/ventra/edit_item.php", { method: "POST", body: fd });
      const data = await res.json();
      if (data.status === "ok") {
        showToast("✅ Сохранено");
        editElement.textContent = newName;
        if (editType === "home") {
            const row = editElement.closest(".home-item");
            const btn = row.querySelector(".btn-edit");
            isDisable ? row.classList.add("disabled") : row.classList.remove("disabled");
            btn.dataset.disable = isDisable;
            btn.dataset.name = newName;
        }
        document.getElementById("editModal").classList.remove("show");
      }
    } catch (e) { showToast("❌ Ошибка сервера", "error"); }
  });

  document.getElementById("cancelEdit").addEventListener("click", () => document.getElementById("editModal").classList.remove("show"));
});
</script>
</body>
</html>