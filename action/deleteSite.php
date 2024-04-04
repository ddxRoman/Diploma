<? require_once 'connect.php';
$id = $_POST['id'];
mysqli_query($connect, "DELETE FROM `sites` WHERE `sites`.`id` = '$id'");
    header('Location: ../folders/addsiteForm.php');
    ?>  