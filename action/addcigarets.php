<?php
        require_once 'connect.php'; // Проверка подключения к БД
        $time = date("H:i");
        $count=$_POST['count'];
        $time=$_POST['time'];
        $date=$_POST['day'];
        if ($date!=Null){
                mysqli_query($connect, "INSERT INTO `smoke` (`id`, `count`, `time`, `date`)
        VALUES (NULL, '$count', '$time', '$date' )");
        echo"True date not Null";
         header ('Location: ../folders/smokes.php');
}else{
        echo"False date Null";
        mysqli_query($connect, "INSERT INTO `smoke` (`id`, `count`, `time`, `date`)
        VALUES (NULL, '$count', '$time', NOW() )");
 header ('Location: ../folders/smokes.php');
}
?>
