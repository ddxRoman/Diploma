<?php
require_once "../../action/connect.php";

$street = $_GET['street'] ?? '';
$build = $_GET['build'] ?? '';

$competitors = [];
$keys = [];
$note = '';

if ($street && $build) {
    $stmt = $connect->prepare("SELECT id FROM ventra_home WHERE street = ? AND build = ?");
    $stmt->bind_param("ss", $street, $build);
    $stmt->execute();
    $result = $stmt->get_result();
    $home = $result->fetch_assoc();

    if ($home) {
        $adress_id = $home['id'];

        $stmt2 = $connect->prepare("SELECT * FROM ventra_home_notefication WHERE adress_id = ?");
        $stmt2->bind_param("i", $adress_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $data = $result2->fetch_assoc();

        if ($data) {
            $competitors = array_map('trim', explode(',', $data['competitors'] ?? ''));
            $keys = array_map('trim', explode(',', $data['door_key'] ?? ''));
            $note = $data['note'] ?? '';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактирование заметки</title>
  <link rel="stylesheet" href="../../css/ventra-style.css">
  <style>
    body {
      font-family: "Inter", system-ui, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      padding: 25px 20px 35px;
    }

    h1 {
      font-size: 22px;
      text-align: center;
      margin-bottom: 25px;
      color: #222;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
      color: #444;
    }

    /* --- сетка конкурентов --- */
    .checkbox-group {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 14px;
    }

    .checkbox-item {
      position: relative;
      background: #f8f9fa;
      border: 2px solid #e0e0e0;
      border-radius: 14px;
      padding: 15px 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.25s ease;
      user-select: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .checkbox-item:hover {
      background: #eef6ff;
      border-color: #007bff;
      transform: translateY(-2px);
    }

    .checkbox-item img {
      width: 50px;
      display: block;
      margin: 10px auto 5px;
    }

    .checkbox-item span {
      display: block;
      font-size: 15px;
      margin-top: 4px;
    }

    /* --- активный выбор --- */
    .checkbox-item input:checked + img {
      filter: drop-shadow(0 0 5px #007bff);
    }

    .checkbox-item input:checked ~ span {
      color: #007bff;
      font-weight: 600;
    }

    .checkbox-item input:checked ~ img,
    .checkbox-item input:checked ~ span,
    .checkbox-item input:checked ~ * {
      animation: selectPulse 0.2s ease;
    }

    /* 🔷 Заметное выделение активного блока */
    .checkbox-item.active {
      background: #e7f1ff;
      border-color: #007bff;
      box-shadow: 0 0 10px rgba(0,123,255,0.3);
      transform: translateY(-2px);
    }

    @keyframes selectPulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .checkbox-item input {
      display: none;
    }

    select {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      font-size: 15px;
      background: white;
      box-sizing: border-box;
    }

    textarea {
      width: 100%;
      min-height: 90px;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      font-size: 15px;
      resize: vertical;
      box-sizing: border-box;
      transition: all 0.2s ease;
    }

    textarea:focus, select:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
      outline: none;
    }

    button {
      background: #007bff;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 3px 10px rgba(0,123,255,0.25);
    }

    button:hover {
      background: #0056d8;
      transform: translateY(-1px);
    }

    /* 📱 мобильная адаптация */
    @media (max-width: 600px) {
      .container {
        margin: 0 10px;
        padding: 20px 15px 40px;
        border-radius: 0;
        box-shadow: none;
      }

      h1 {
        font-size: 20px;
      }

      .checkbox-group {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
      }

      .checkbox-item img {
        width: 45px;
      }

      button {
        font-size: 17px;
        padding: 14px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Редактирование заметки</h1>

    <form action="../../action/ventra/add_note_home.php?street=<?=htmlspecialchars($street)?>&build=<?=htmlspecialchars($build)?>" method="post">
      <div>
        <label>Выбери конкурентов</label>
        <div class="checkbox-group">

          <label class="checkbox-item <?=in_array('MTC', $competitors) ? 'active' : ''?>">
            <input type="checkbox" name="competitors[]" value="MTC" <?=in_array('MTC', $competitors) ? 'checked' : ''?>>
            <img src="../../file/icons/ventra/mts.png" alt="МТС">
            <span>МТС</span>
          </label>

          <label class="checkbox-item <?=in_array('Ростелеком', $competitors) ? 'active' : ''?>">
            <input type="checkbox" name="competitors[]" value="Ростелеком" <?=in_array('Ростелеком', $competitors) ? 'checked' : ''?>>
            <img src="../../file/icons/ventra/rostelecom.png" alt="Ростелеком">
            <span>Ростелеком</span>
          </label>

          <label class="checkbox-item <?=in_array('Другие', $competitors) ? 'active' : ''?>">
            <input type="checkbox" name="competitors[]" value="Другие" <?=in_array('Другие', $competitors) ? 'checked' : ''?>>
            <img src="../../file/icons/ventra/other.png" alt="Прочие">
            <span>Прочие</span>
          </label>

          <label class="checkbox-item <?=in_array('Только Билайн', $competitors) ? 'active' : ''?>">
            <input type="checkbox" name="competitors[]" value="Только Билайн" <?=in_array('Только Билайн', $competitors) ? 'checked' : ''?>>
            <img src="../../file/icons/ventra/beeline.png" alt="Билайн">
            <span>Только Билайн</span>
          </label>

        </div>
      </div>

      <div>
        <label for="keys">Подходят ли ключи (нужно выбрать подъезды)</label>
        <select name="keys[]" id="keys" multiple>
          <?php for ($i = 1; $i <= 8; $i++): ?>
            <option value="<?=$i?>" <?=in_array((string)$i, $keys) ? 'selected' : ''?>>Подъезд №<?=$i?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div>
        <label for="note">Примечание</label>
        <textarea id="note" name="note" rows="4" placeholder="Введите заметку..."><?=htmlspecialchars($note)?></textarea>
      </div>

      <button type="submit">💾 Сохранить</button>
    </form>
  </div>

  <script>
    // визуальное выделение активных конкурентов
    document.querySelectorAll('.checkbox-item input').forEach(input => {
      input.addEventListener('change', e => {
        e.target.closest('.checkbox-item').classList.toggle('active', e.target.checked);
      });
    });
  </script>
</body>
</html>
