<? require_once 'connect.php';
$id = $_POST['id'];
$name = $_POST['name'];
$url = $_POST['url'];
$categorie = $_POST['categories'];
    mysqli_query($connect, "UPDATE `sites` SET  `name` = '$name', `url` = '$url', `categories_id`= '$categorie' WHERE `id` = '$id'");
    header('Location: ../folders/addsiteForm.php');
    ?>  