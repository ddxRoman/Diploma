<?
require_once '../connect.php';
$street = $_POST['street'];
$build = $_POST['build'];



if($ventra==null){
     mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`)
     VALUES (NULL, '$street', '$build' )");
      header ('Location: ../../folders/ventra/home.php');
}else 
foreach ($ventra as $ventras) {

if($ventras[1]==$street && $ventras[2]==$build){
echo '<meta http-equiv="refresh" content="5;url=../../folders/ventra/home.php">';
echo 'Дом '.$street.'-'.$build. ' уже есть в базе';
?> <br> <a href="../../folders/ventra/home.php">
    <button>Перейти</button>
    </a>
    <?
exit;

}
else {$coincidence="false";}
}

if($coincidence=="false"){
         mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`)
     VALUES (NULL, '$street', '$build' )");
echo '<meta http-equiv="refresh" content="5;url=../../folders/ventra/home.php">';
echo 'Дом '.$street.'-'.$build. ' добавлен';
?> <br> <a href="../../folders/ventra/home.php">
    <button>Перейти</button>
    </a>
    <?
exit;
}

?>

