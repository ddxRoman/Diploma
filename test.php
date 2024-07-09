<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?require_once "action/connect.php";?>
<body>
<a href="">
    <button>Download</button>
</a><br><br>
<?
$test = mysqli_query($connect, "SELECT * FROM `test`"); // Подключение к определенной таблице, и получение Статуса записи
$test = mysqli_fetch_all($test); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
$min = -150000; 
$max = 150000;
$txt = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius nulla obcaecati tempore inventore cumque incidunt excepturi? Dignissimos enim saepe rem nihil earum cumque itaque impedit nam nostrum molestias tempore, commodi mollitia illo facere omnis praesentium incidunt deleniti aut. Iste alias facilis eaque, magni fugit dolores omnis voluptatum voluptas, distinctio reprehenderit amet sapiente praesentium quia ratione maiores enim dignissimos nisi officiis doloribus recusandae nobis cum debitis natus reiciendis. Sit saepe tempore deleniti ut perspiciatis doloribus? Vitae velit atque aliquid ipsum magni mollitia hic in, sint dolorem doloremque! Et dignissimos consequuntur dolorem sapiente enim, consectetur in voluptatum maiores voluptates iste tenetur? Adipisci, hic. Pariatur nobis perferendis deleniti quibusdam, quaerat dicta adipisci? Obcaecati animi aut ipsa dicta, eum in molestiae dolore cum nostrum! Suscipit unde mollitia eveniet numquam, veritatis maiores quas dignissimos commodi sunt natus doloremque soluta illum. In maiores atque corporis tenetur nemo saepe magni ducimus qui architecto laboriosam, corrupti dolor aperiam.";
    for ($n = 0; $n <= 100000; $n++) {
        // $txt=rand( $min, $max);
 mysqli_query($connect, "INSERT INTO `test` (`id`, `one`, `two`, `three`, `four`, `pyat`, `six`, `seven`, `eight`, `nine`) VALUES (NULL, '$txt','$txt','$txt','$txt','$txt','$txt','$txt','$txt','$txt' );");
echo $txt."<br>";
} 
?>

</body>
</html>