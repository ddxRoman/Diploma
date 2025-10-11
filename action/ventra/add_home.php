<?php
require_once '../connect.php';

$street = isset($_POST['street']) ? trim($_POST['street']) : '';
$build = isset($_POST['build']) ? trim($_POST['build']) : '';

if ($ventra == null) {
    mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`)
    VALUES (NULL, '$street', '$build')");
    header('Location: ../../folders/ventra/home.php');
    exit;
} else {
    foreach ($ventra as $ventras) {
        if ($ventras[1] == $street && $ventras[2] == $build) {
            echo '<meta http-equiv="refresh" content="5;url=../../folders/ventra/home.php">';
            echo 'Дом ' . htmlspecialchars($street) . '-' . htmlspecialchars($build) . ' уже есть в базе';
            ?>
            <br>
            <a href="../../folders/ventra/home.php">
                <button>Перейти</button>
            </a>
            <?php
            exit;
        } else {
            $coincidence = "false";
        }
    }

    if ($coincidence == "false") {
        mysqli_query($connect, "INSERT INTO `ventra_home` (`id`, `street`, `build`)
        VALUES (NULL, '$street', '$build')");
        echo '<meta http-equiv="refresh" content="5;url=../../folders/ventra/home.php">';
        echo 'Дом ' . htmlspecialchars($street) . '-' . htmlspecialchars($build) . ' добавлен';
        ?>
        <br>
        <a href="../../folders/ventra/home.php">
            <button>Перейти</button>
        </a>
        <?php
        exit;
    }
}
?>
