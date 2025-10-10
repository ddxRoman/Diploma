<?php
require_once "../../action/connect.php";

$streets = array_unique(array_column($ventra_street, 'street'));
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../../css/ventra-style.css">
    <title>Дома</title>
</head>

<body>

<form class="ventra_add_home" action="../../action/ventra/add_home.php" method="post">
    <input type="text" name="street" placeholder="Улица">
    <input type="text" name="build" placeholder="Дом">
    <button>Добавить</button>
</form>
<hr>


<form class="ventra" method="get" action="current_home.php?street=<?=$street?>&build=<?=$build?>">
    <select name="street" id="street">
        <option value="">Выберите улицу</option>
        <?php foreach ($ventra_street as $ventra_streets): ?>
            <option value="<?= htmlspecialchars($ventra_streets[1], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($ventra_streets[1]) ?></option>
        <?php endforeach; ?>
    </select><br>

    <select name="build" id="build">
        <option value="">Сначала выберите улицу</option>
    </select><br>

    <button class="btn_add_comments" type="submit">Найти</button>
</form>

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
        return response.json(); // ждём JSON
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
</body>
</html>
