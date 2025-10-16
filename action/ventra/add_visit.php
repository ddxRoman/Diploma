<?php
require_once '../connect.php';

$visit_date = trim($_POST['visit_date']);
$adress_id = intval($_GET['id']);

// Проверяем обязательные данные
if (empty($visit_date) || empty($adress_id)) {
    die('<div class="page page--error">Ошибка: не переданы необходимые данные.</div>');
}

/* --- Находим адрес по ID --- */
$addr_stmt = $connect->prepare("SELECT `street`, `build` FROM `ventra_home` WHERE `id` = ?");
$addr_stmt->bind_param("i", $adress_id);
$addr_stmt->execute();
$addr_result = $addr_stmt->get_result();

if ($addr_result->num_rows === 0) {
    die('<div class="page page--error">Ошибка: такой адрес не найден.</div>');
}

$addr = $addr_result->fetch_assoc();
$street = htmlspecialchars($addr['street']);
$build = htmlspecialchars($addr['build']);
$addr_stmt->close();

/* --- Проверяем, есть ли запись в visit_home_date --- */
$check_stmt = $connect->prepare("SELECT * FROM `visit_home_date` WHERE `adress_id` = ? AND `visit_date` = ?");
$check_stmt->bind_param("is", $adress_id, $visit_date);
$check_stmt->execute();
$visit_data = $check_stmt->get_result()->fetch_assoc();
$check_stmt->close();

if (!$visit_data) {
    $message = '<h2 class="visit-form__title visit-form__title--info">ℹ️ Запись для этой даты ещё не создана</h2>
                <p class="visit-form__subtitle">Вы можете заполнить форму ниже — данные сохранятся при отправке.</p>';
} else {
    $message = '<h2 class="visit-form__title visit-form__title--update">📅 Визит уже сохранён</h2>
                <p class="visit-form__subtitle">Дата визита: <b>' . htmlspecialchars($visit_date) . '</b> для дома <b>' . $street . ' ' . $build . '</b>.</p>';
}

/* --- Подставляем значения для формы (если есть) --- */
$dorhenders_checked = !empty($visit_data['dorhenders']) ? 'checked' : '';
$listovki_checked = !empty($visit_data['listovki']) ? 'checked' : '';
$pochtovye_checked = !empty($visit_data['pochtovye_yashiki']) ? 'checked' : '';
$comment_value = htmlspecialchars($visit_data['comment'] ?? '');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Форма визита</title>
<style>
/* ---------- БАЗОВЫЙ СТИЛЬ СТРАНИЦЫ ---------- */
.page {
    font-family: system-ui, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #f0f2f5;
    color: #222;
    text-align: center;
    padding: 20px;
    box-sizing: border-box;
}

.page--error {
    background: #f8d7da;
    color: #721c24;
    font-size: 1.2rem;
}

/* ---------- БЭМ: visit-form ---------- */
.visit-form {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 20px;
    width: 100%;
    max-width: 340px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.visit-form__title {
    margin-bottom: 10px;
    font-size: 1.2rem;
}
.visit-form__title--info {
    color: #6c757d;
}
.visit-form__title--update {
    color: #17a2b8;
}
.visit-form__subtitle {
    font-size: 0.95rem;
    color: #444;
    margin-bottom: 15px;
}

.visit-form__checkbox {
    display: block;
    text-align: left;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.visit-form__textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    resize: vertical;
    font-size: 0.95rem;
    font-family: inherit;
}

.visit-form__button {
    margin-top: 15px;
    width: 100%;
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
}
.visit-form__button:hover {
    background: #0056b3;
}

.page__back-link {
    margin-top: 20px;
    text-decoration: none;
    background: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: background 0.3s ease;
}
.page__back-link:hover {
    background: #5a6268;
}

/* ---------- Мобильная адаптация ---------- */
@media (max-width: 480px) {
    .visit-form {
        width: 100%;
        max-width: none;
        padding: 15px;
    }
    .visit-form__title {
        font-size: 1rem;
    }
    .visit-form__button {
        padding: 12px;
        font-size: 1rem;
    }
}
</style>
</head>
<body>

<div class="page">
    <?= $message ?>

    <form class="visit-form" action="save_visit_note.php" method="post">
        <input type="hidden" name="street" value="<?= $street ?>">
        <input type="hidden" name="build" value="<?= $build ?>">
        <input type="hidden" name="adress_id" value="<?= $adress_id ?>">
        <input type="hidden" name="visit_date" value="<?= htmlspecialchars($visit_date) ?>">

        <label class="visit-form__checkbox">
            <input type="checkbox" name="dorhenders" value="1" <?= $dorhenders_checked ?>> Дорхендеры
        </label>

        <label class="visit-form__checkbox">
            <input type="checkbox" name="listovki" value="1" <?= $listovki_checked ?>> Листовки на этажах
        </label>

        <label class="visit-form__checkbox">
            <input type="checkbox" name="pochtovye_yashiki" value="1" <?= $pochtovye_checked ?>> Почтовые ящики
        </label>

        <label class="visit-form__checkbox" style="font-weight:600;">Комментарий:</label>
        <textarea name="comment" rows="4" class="visit-form__textarea"><?= $comment_value ?></textarea>

        <button type="submit" class="visit-form__button">💾 Сохранить</button>
    </form>

    <a href="../../folders/ventra/current_home.php?street=<?= urlencode($street) ?>&build=<?= urlencode($build) ?>" class="page__back-link">
        ⬅ Вернуться назад
    </a>
</div>

</body>
</html>
