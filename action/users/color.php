<?         

session_start();
        require_once '../connect.php'; // Проверка подключения к БД
        $id_user= $_SESSION['user']['id'];
        $setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
        $setting = mysqli_fetch_assoc($setting);
        $bg_color=$setting['background'];
        $text_color=$setting['text_color'];
        $btn_color=$setting['btn_color'];
$bg_color=$_POST['bg'];
$text_color=$_POST['txtColor'];
$btn_color=$_POST['btn_color'];
        mysqli_query($connect, "UPDATE `settings_users` SET `background` = '$bg_color', `text_color` = '$text_color', `btn_color` = '$btn_color' WHERE `id_user` = '$id_user'");
         header('Location: settings.php');
        ?>
