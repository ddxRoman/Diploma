<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="form_addCreeds">
        <form action="../action/newcreeds.php" method="post" >
            <input required name="name" placeholder="NameSite">
            <input required name="url" placeholder="url">
            <input required name="login" placeholder="Login/email">
            <input required name="password" placeholder="password"><br>
            <button class="add_creeds_btn">Сохранить</button>
        </form>
    </div>
</body>
</html>