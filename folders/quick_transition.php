<? require_once "function/profilecheck.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Быстрый переход</title>
</head>
<body>
<form target="_blank" action="../action/header.php" method="post" >
<input type="search" name="yandex" placeholder="Яндекс" >
<a href="header.php" > 
    <button type="submit">Поиск</button>
</a>
</form>
<form target="_blank" action="../action/header.php" method="post">
<input type="search" name="google" placeholder="Google" >
<a href="header.php" > 
    <button type="submit">Поиск</button>
</a>
</form>

</body>
</html>