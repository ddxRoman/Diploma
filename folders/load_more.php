<?php
require_once "../action/connect.php";

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$query = mysqli_query($connect, "SELECT * FROM helper_log ORDER BY date DESC LIMIT 20 OFFSET $offset");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

foreach ($rows as $row): ?>
<tr>
    <td data-label="Имя">
        <a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">
            <?= htmlspecialchars($row['name']) ?>
        </a>
    </td>
    <td data-label="Дата"><?= htmlspecialchars($row['date']) ?></td>
</tr>
<?php endforeach; ?>
