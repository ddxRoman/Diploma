<?php 
require_once "../function/checkaut.php";
require_once "../action/connect.php";

$query = mysqli_query($connect, "SELECT * FROM helper_log ORDER BY date DESC LIMIT 20");
$helper_logs = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helper Logs</title>
    <style>
body {
    background-color: #f3f4f6;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
}

.helper {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    width: 90%;
    max-width: 900px;
}

/* Формы */
.helperSearch form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
    width: 100%;
}

.helperSearch label {
    font-size: 14px;
    margin-bottom: 6px;
    color: #111827;
    font-weight: 500;
}

.input-group {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.input-group input {
    flex: 1;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 15px;
    transition: all 0.2s;
}

.input-group input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
    outline: none;
}

.input-group button {
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 18px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
}

.input-group button:hover {
    background: #1e40af;
    transform: translateY(-1px);
}

/* Кнопки ссылок */
.link {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 20px 0;
}

.link button {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 18px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.link button:hover {
    background: #1e40af;
}

/* Таблица */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
}

table thead {
    background: #f9fafb;
}

th, td {
    padding: 12px 16px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

th {
    font-weight: 600;
    color: #374151;
}

td a {
    color: #2563eb;
    text-decoration: none;
}

td a:hover {
    text-decoration: underline;
}

/* Кнопка "Показать ещё" */
#loadMore {
    display: block;
    margin: 20px auto 0;
    background: #10b981;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

#loadMore:hover {
    background: #059669;
}

/* Адаптивность */
@media (max-width: 700px) {
    .input-group {
        flex-direction: column;
        align-items: stretch;
    }

    .input-group button {
        width: 100%;
    }

    table, th, td {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
<div class="helper">
    <div class="helperSearch">
<form target="_blank" action="../action/helper.php" method="post">
    <label for="ticket">MEDSUP</label>
    <div class="input-group">
        <input type="number" id="ticket" name="ticket" placeholder="Введите номер">
        <button type="submit">GO</button>
    </div>
</form>

<form target="_blank" action="../action/jiraСsd.php" method="post">
    <label for="ticketJira">Минусовое значение — это SUP</label>
    <div class="input-group">
        <input type="number" id="ticketJira" name="ticketJira" placeholder="MEDRWK">
        <button type="submit">GO</button>
    </div>
</form>


        <div class="link">
            <a href="https://jira.csd.com.ua/secure/Tempo.jspa#/my-work" target="_blank"><button>TEMPO</button></a>
            <a href="https://helper.bizonoff-dev.net/admin/projects/medcloud/knowledge-bases/dokumentatsiia-funktsionala" target="_blank"><button>Helper</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1sjEopcZ5WOQyIz3S4ChNKx26nIP4iKaXx15vWqIn_rA/edit?gid=2048374952#gid=2048374952" target="_blank"><button>Daily</button></a>
        </div>
    </div>

    <table id="logTable">
        <thead>
            <tr><th>Имя</th><th>Дата</th></tr>
        </thead>
        <tbody>
        <?php foreach ($helper_logs as $row): ?>
            <tr>
                <td data-label="Имя">
                    <a href="<?= htmlspecialchars($row['url']) ?>" target="_blank"><?= htmlspecialchars($row['name']) ?></a>
                </td>
                <td data-label="Дата"><?= htmlspecialchars($row['date']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button id="loadMore">Показать ещё</button>
</div>

<script>
let offset = 20;
document.getElementById("loadMore").addEventListener("click", function() {
    fetch(`load_more.php?offset=${offset}`)
        .then(res => res.text())
        .then(html => {
            if (html.trim() !== "") {
                document.querySelector("#logTable tbody").insertAdjacentHTML("beforeend", html);
                offset += 20;
            } else {
                this.textContent = "Больше записей нет";
                this.disabled = true;
            }
        });
});
</script>
</body>
</html>
