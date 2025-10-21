<?
$current_year=date("Y");
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "function/check-device-for-admin.php";
require_once "action/connect.php";
require_once "action/users/StyleAndSettings.php";
if ($role!= 1) {
    header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ORS-Admin Панель</title>
<link rel="icon" type="image/png" href="file/icons/Logo.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<style>
:root {
  --accent1: #a854ff;     /* фирменный фиолетовый */
  --accent2: #ff3fa4;     /* фирменный розовый */
  --bg: #f7f4ff;          /* светлый фон */
  --card: #ffffff;         /* белые блоки */
  --text: #2b0040;         /* тёмно-фиолетовый */
  --radius: 14px;
  --shadow: 0 4px 15px rgba(168, 84, 255, 0.25);
}

/* --- Общий стиль страницы --- */
body {
  margin: 0;
  font-family: "Inter", "Segoe UI", sans-serif;
  background: var(--bg);
  color: var(--text);
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
}

/* --- Шапка --- */
.header {
  width: 100%;
  background: linear-gradient(90deg, var(--accent1), var(--accent2));
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
  padding: 14px 30px;
  box-shadow: var(--shadow);
  border-bottom: 3px solid rgba(255, 255, 255, 0.2);
}

.header .MD {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  border-radius: var(--radius);
  color: #fff;
  padding: 10px 22px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

.header .MD:hover {
  background: rgba(255, 255, 255, 0.35);
  transform: scale(1.05);
}

/* --- Основной контейнер --- */
.all {
  width: 100%;
  max-width: 1300px;
  padding: 20px;
  box-sizing: border-box;
}

/* --- Панель с кнопками --- */
.MisPanel {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 14px;
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 25px 20px;
  margin: 30px auto;
}

.MisPanel a {
  text-decoration: none;
}

.MisPanel button {
  width: 100px;
  height: 50px;
  background: linear-gradient(90deg, var(--accent1), var(--accent2));
  color: white;
  border: none;
  border-radius: var(--radius);
  font-size: 16px;
  font-weight: 500;
  box-shadow: 0 4px 12px rgba(168, 84, 255, 0.3);
  cursor: pointer;
  transition: all 0.25s ease;
}

.MisPanel button:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(255, 63, 164, 0.45);
}

.MisPanel button:active {
  transform: scale(0.97);
  opacity: 0.9;
}

/* --- Разделитель --- */
.misPanel-hr {
  width: 85%;
  margin: 0 auto 20px auto;
  border: none;
  border-top: 2px solid rgba(168, 84, 255, 0.2);
}

/* --- Контент и iframe --- */
.body {
  display: flex;
  justify-content: center;
  gap: 20px;
  width: 100%;
  box-sizing: border-box;
  flex-wrap: wrap;
}

.container {
  flex: 1;
  min-width: 300px;
  max-width: 900px;
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 15px;
}

.container iframe {
  width: 100%;
  height: 600px;
  border: none;
  border-radius: var(--radius);
}

/* --- Правая панель (если есть) --- */
.rmenu {
  width: 350px;
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 10px;
}

.rmenu iframe {
  width: 100%;
  height: 600px;
  border: none;
  border-radius: var(--radius);
}

/* --- Нижняя часть --- */
.footer {
  width: 100%;
  background: var(--card);
  border-top: 2px solid rgba(168, 84, 255, 0.15);
  border-radius: var(--radius) var(--radius) 0 0;
  box-shadow: var(--shadow);
  padding: 20px;
  text-align: center;
  color: var(--text);
  margin-top: 40px;
}

.footer img {
  width: 60px;
  margin-bottom: 10px;
  opacity: 0.8;
}

.footer .ink {
  font-size: 14px;
  line-height: 1.4em;
  color: var(--text);
}

.clock {
  margin-top: 10px;
  font-weight: 600;
  color: var(--accent1);
  font-size: 18px;
}

/* --- Адаптивность --- */
@media (max-width: 900px) {
  .header {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  .MisPanel {
    flex-direction: column;
    align-items: center;
  }
  .MisPanel button {
    width: 100%;
    max-width: 320px;
  }
  .body {
    flex-direction: column;
    align-items: center;
  }
  .rmenu {
    width: 100%;
    max-width: 600px;
  }
}
</style>
</head>

<body>
  <div class="all">
    <div class="header">
      <div class="knowledge">
        <a href="index.php" target="_self">
          <button class="MD">Админка</button>
        </a>
      </div>
      <div class="Right_head">
        <?php require_once "action/profileindex.php"; ?>
      </div>
    </div>

    <div class="MisPanel">
      <a href="folders/addcreeds.php" target="1"><button>Доступы</button></a>
      <a href="folders/addsiteForm.php" target="1"><button>Добавить сайт</button></a>
      <a href="https://s2.hostiman.ru/phpmyadmin/index.php"><button>База данных</button></a>
      <a href="https://my.hostiman.ru/cabinet/services/shared/files/245637"><button>Менеджер файлов</button></a>
      <a href="folders/TgBotForm.php" target="1"><button>Бот</button></a>
      <a href="finance/finance.php" target="_blank"><button>Финансы</button></a>
      <!-- <a href="folders/tracking.php" target=""><button>Трек</button></a> -->
      <a href="folders/ventra.php" target="_blank"><button>Вентра</button></a>
    </div>

    <hr class="misPanel-hr">

    <div class="body">
      <div class="container">
        <iframe name="1" src=""></iframe>
      </div>

      <div class="rmenu">
        <iframe name="task" src="Taskmanager/task_bootstrap.php"></iframe>
      </div>
    </div>

    <div class="footer">
      <p class="ink">
        <img src="file/icons/Logo.png" alt="Logo"><br>
        ORStudio<br>
        Оксентий Роман Сергеевич Студио<br>
        © 2022–<?=date("Y")?>
      </p>
      <div id="clock" class="clock"></div>
      <script src="JavaScript/clock.js"></script>
    </div>
  </div>
</body>
</html>
