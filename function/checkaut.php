<?php
session_start();
if($_SESSION['user']){
?>
<?php
}
else {
    header ('Location: action/autorization.php');
}
?>