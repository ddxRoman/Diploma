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
<link rel="stylesheet" href="css/adminStyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
  <div class="all">
    <div class="header_admin">
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
