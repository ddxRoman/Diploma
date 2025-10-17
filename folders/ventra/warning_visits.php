<?php
// Подключение к базе данных (замени на свои данные)

// $host = 'localhost'; $dbname = 'diploma'; $user = 'user'; $pass = 'qazwsx';
$host = 'localhost';$dbname = 'diploma';$user = 'ddx';$pass = 'Beetle19';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

// ---------------------------------------------------
// Структура:
// ventra_home(id, street, build, ...)
// visit_home_date(id, address_id, visit_date, ...)
// ---------------------------------------------------

// Получаем дома, где последний визит был более 30 дней назад или не было визита вообще
$query = "
    SELECT 
        h.id,
        h.street,
        h.build,
        MAX(v.visit_date) AS last_visit
    FROM ventra_home h
    LEFT JOIN visit_home_date v ON v.adress_id = h.id
    GROUP BY h.id, h.street, h.build
    HAVING last_visit IS NULL OR last_visit < DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    ORDER BY last_visit DESC;
";


$stmt = $pdo->prepare($query);
$stmt->execute();
$houses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дома с просроченным визитом</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f8fa;
            margin: 0;
            padding: 0;
        }
        .nav {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  background: #007bff;
  padding: 12px 0;
  gap: 20px;
  position: sticky;
  top: 0;
  z-index: 100;
}
.nav__link {
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  padding: 8px 14px;
  border-radius: 6px;
  transition: background 0.3s ease;
}
.nav__link:hover,
.nav__link--active {
  background: rgba(255, 255, 255, 0.2);
}
        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
        tr:hover {
            background: #fafafa;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        /* Адаптивный дизайн */
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th {
                display: none;
            }
            td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 12px;
                font-weight: bold;
                color: #333;
            }
        }
        a{
            text-decoration: none;
            color: black;
        }

        .refresh-btn {
            display: block;
            margin: 0 auto 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
        }
        .refresh-btn:hover {
            background: #0056b3;
        }
          .nav-bar__link {
    padding: 8px 14px;
    font-size: 0.9rem;
  }
    </style>
</head>
<body>

<nav class="nav">
  <a href="home.php" class="nav__link">Главная</a>
  <a href="visit_list.php" class="nav__link ">Визиты</a>
    <a href="warning_visits.php" class="nav__link nav__link--active">Важные визиты</a>
</nav>

    <div class="container">
        <h1>Дома с просроченным визитом</h1>

        <button class="refresh-btn" onclick="window.location.reload()">🔄 Обновить</button>

        <?php if (count($houses) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Улица</th>
                        <th>Номер дома</th>
                        <th>Последний визит</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($houses as $house): ?>
                        <tr>
                            <td data-label="Улица">
        <a href="../ventra/current_home.php?street=<?=$house['street']?>&build=<?=$house['build']?>">
            <?= htmlspecialchars($house['street']) ?>
        </a>
    </td>
    
    <td data-label="Номер дома">
    <a href="../ventra/current_home.php?street=<?=$house['street']?>&build=<?=$house['build']?>">
        <?= htmlspecialchars($house['build']) ?>
    </a>
</td>

<td data-label="Последний визит">
    <a href="../ventra/current_home.php?street=<?=$house['street']?>&build=<?=$house['build']?>">
    <?= $house['last_visit'] ? htmlspecialchars($house['last_visit']) : 'Визитов на дом не было' ?>
</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">✅ Все дома были посещены в последние 30 дней</div>
        <?php endif; ?>
    </div>
</body>
</html>
