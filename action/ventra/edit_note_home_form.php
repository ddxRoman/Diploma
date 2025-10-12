<?php
require_once "../../action/connect.php";

$street = $_GET['street'] ?? '';
$build = $_GET['build'] ?? '';

$competitors = [];
$keys = [];
$note = '';

if ($street && $build) {
    // 1️⃣ Находим ID адреса
    $stmt = $connect->prepare("SELECT id FROM ventra_home WHERE street = ? AND build = ?");
    $stmt->bind_param("ss", $street, $build);
    $stmt->execute();
    $result = $stmt->get_result();
    $home = $result->fetch_assoc();

    if ($home) {
        $adress_id = $home['id'];

        // 2️⃣ Загружаем данные по этому адресу из ventra_home_notefication
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
  <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <title>Редактирование заметки</title>
</head>

<body>
  <form action="../../action/ventra/add_note_home.php?street=<?=htmlspecialchars($street)?>&build=<?=htmlspecialchars($build)?>" method="post">
    <label>Выбери конкурентов</label>
    <div class="checkbox-group">
      <label class="checkbox-item"> МТС
        <input type="checkbox" name="competitors[]" hidden value="MTC" <?=in_array('MTC', $competitors) ? 'checked' : ''?>>
        <img src="../../file/icons/ventra/mts.png" alt="МТС">
      </label>

      <label class="checkbox-item"> Ростелеком
        <input type="checkbox" name="competitors[]" hidden value="Ростелеком" <?=in_array('Ростелеком', $competitors) ? 'checked' : ''?>>
        <img src="../../file/icons/ventra/rostelecom.png" alt="Ростелеком">
      </label>

      <label class="checkbox-item"> прочее
        <input type="checkbox" name="competitors[]" hidden value="Другие" <?=in_array('Другие', $competitors) ? 'checked' : ''?>>
        <img src="../../file/icons/ventra/other.png" alt="Другие">
      </label>

      <label class="checkbox-item"> Только Билайн
        <input type="checkbox" name="competitors[]" hidden value="Только Билайн" <?=in_array('Только Билайн', $competitors) ? 'checked' : ''?>>
        <img src="../../file/icons/ventra/beeline.png" alt="Билайн">
      </label>
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

    <button type="submit">Сохранить</button>
  </form>
</body>
</html>
