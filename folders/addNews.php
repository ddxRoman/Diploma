<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>newNews</title>
</head>
<body>
    <form action="../action/addnews.php" method="post">
        <input required name="newsheader" placeholder="Зоголовок"><br>
        <textarea required name="news"></textarea><br>
        <button>Опубликовать</button>

    </form>
</body>
</html>