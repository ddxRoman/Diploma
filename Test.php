<?
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
require_once "action/users/StyleAndSettings.php";

if ($_SESSION['user']['status'] != 9) {
    header('Location: index.php');
    }
    $personal = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
    $personal = mysqli_fetch_all($personal); // Выбирает все строки из набора $product и помещает их в массив  $product
?>

<!DOCTYPE html>
<html lang="en">


            <div class="contant">
<table>

<?php
        foreach ($personal as $personals) { // Перебор массива $product c его записью в массив $productS
            
            ?>
            <tr>

                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[2]?> </a> </td>
                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[1]?> </a> </td>
                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[3]?> </a> </td>
                <td><?=$personals[4]?> </td>
                <td><?=$personals[5]?> </td>
                <td><?=$personals[8]?> </td>
                <td><?=$personals[7]?> </td>
               
            </tr>    
            <?
        }
      ?>  </table>
                </div>
            <!-- ТАм вообще есть отдельный файл с проверкой, надо с ним поработать -->
        </div>
        <hr class="footer-hr">
        <div class="footer">
                <div></div>
            <div class="refresh">

                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-2023 </p>
            </div>
            <div id="clock" class="clock">         
            <script src="../JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
        </div>
    </div>
</body>
</html>


<?
class User
{
  public $name;
  public $surname;
  public function getName()
  {
    return $this->name;
    return $this->surname;

  }
  public function setName($name, $surname)
  {
    $this->name = $name;
    $this->surname=$surname;
  }
}


$person = new User();

$person->setName('Wer', 'Bob');

echo $person->getName('a','b');



$config = new MenuConfig();
$config->title = 'Foo';
$config->body = 'Bar';
$config->buttonText = 'Baz';
$config->cancelLabel = true;

function createMenu(MenuConfig $config) {
    // ...
}
echo $config->body;