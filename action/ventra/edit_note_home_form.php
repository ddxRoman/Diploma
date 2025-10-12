<?php

$street = $_GET['street'];
$build = $_GET['build'];


?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <title>Форма конкурентов</title>
<?php
require_once "../../action/connect.php";

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
  <title>Дома</title>
  <style>
   
  </style>
</head>

<body>

  <script>
    document.getElementById('street').addEventListener('change', function () {
      const street = this.value;
      const buildselect = document.getElementById('build');

      if (!street) {
        buildselect.innerHTML = '<option value="">Сначала выберите улицу</option>';
        return;
      }

      buildselect.innerHTML = '<option>Загрузка...</option>';

      fetch('get_build.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
        body: 'street=' + encodeURIComponent(street)
      })
      .then(response => {
        if (!response.ok) throw new Error('HTTP error ' + response.status);
        return response.json();
      })
      .then(data => {
        buildselect.innerHTML = '';
        if (!Array.isArray(data) || data.length === 0) {
          buildselect.innerHTML = '<option value="">Дома не найдены</option>';
          return;
        }
        data.forEach(build => {
          const opt = document.createElement('option');
          opt.value = build;
          opt.textContent = build;
          buildselect.appendChild(opt);
        });
      })
      .catch(err => {
        console.error('Fetch error:', err);
        buildselect.innerHTML = '<option value="">Ошибка загрузки</option>';
      });
    });
  </script>



<body>

    <div>
        <?
        foreach($ventra_note_current as $ventra_note_currents){
?>
<table>
    <tr>
        <td><b>Ключи:</b></td>
        <td><?=$ventra_note_currents[3]?></td>
    </tr>
    <tr>
        <td><b>Конкуренты:</b></td>
        <td><?=$ventra_note_currents[4]?></td>
    </tr>
    <tr>
        <td><b>Заметка: </b></td>
        <td><?=$ventra_note_currents[2]?></td>
    </tr>
</table>


<?

        }
        ?>
    </div>

  <form action="../../action/ventra/add_note_home.php?street=<?=$street?>&build=<?=$build?>" method="post">
    <label>Выбери конкурентов</label>
    <div class="checkbox-group">
      <label class="checkbox-item"> МТС
        <input type="checkbox" name="competitors[]" hidden value="MTC">
        <img src="../../file/icons/ventra/mts.png" alt="МТС">
      </label>

      <label class="checkbox-item"> Ростелеком
        <input type="checkbox" name="competitors[]" hidden value="Ростелеком">
        <img src="../../file/icons/ventra/rostelecom.png" alt="Ростелеком">
      </label>

      <label class="checkbox-item"> прочее
        <input type="checkbox" name="competitors[]" hidden value="Другие">
        <img src="../../file/icons/ventra/other.png" alt="Другой">
      </label>
      <label class="checkbox-item"> Только Билайн
        <input type="checkbox" name="competitors[]" hidden value="Только Билайн">
        <img src="../../file/icons/ventra/beeline.png" alt="Другой">
      </label>
    </div>

    <div>
      <label for="keys">Подходят ли ключи (нужно выбрать подъезды)</label>
      <select name="keys[]" id="keys"  multiple>
        <option  value="1">Подъезд №1</option>
        <option  value="2">Подъезд №2</option>
        <option  value="3">Подъезд №3</option>
        <option  value="4">Подъезд №4</option>
        <option  value="5">Подъезд №5</option>
        <option  value="6">Подъезд №6</option>
        <option  value="7">Подъезд №7</option>
        <option  value="8">Подъезд №8</option>
      </select>
    </div>

    <div>
      <label for="note">Примечание</label>
      <textarea id="note" name="note" rows="4" placeholder="Введите заметку..."></textarea>
    </div>

    <button type="submit">Сохранить</button>
  </form>

</body>
</html>
