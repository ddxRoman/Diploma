<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>База знаний</title>
</head>

<style>
        body{
            background-color: aliceblue;
        }
        div{
            /* border: 2px solid #000; */
        }

        .all {
    display: grid;
    margin-left: 2%;
    margin-right: 2%;
    grid-template-rows: 15% 70% 15%  ; /* Хедер, мис панелька, сама полоска hr, боди, нижний hr, футер*/
}
.header{
    text-align: center;
    align-items: center;
}
.container{
    grid-template-columns: 25% 75%;
}
iframe{
    width: 100%;
    height: 300%;

}

</style>
<body>
    <div class="all">
    <div class="header"> <h1 align="center">База знаний</h1></div>
       
    <div class="container">
        <div class="navigation">
        <ol>
   <a href="knowledge/1.html" target="1"><li>Общие сведения</li></a>
   <a href="knowledge/2.html" target="1"><li> Настройки
    <ol>
    <a href="knowledge/3.html" target="1">  <li>Тема</li></a>
    <a href="knowledge/4.html" target="1">  <li>Кнопки</li></a>
    <a href="knowledge/5.html" target="1">   <li>Профиль</li></a>
    </ol>
    <a href="knowledge/6.html" target="1">   <li>Главная страница</li></a>
    <ol>
    <a href="knowledge/7.html" target="1">   <li>Поиск</li></a>
    <a href="knowledge/8.html" target="1">   <li>Профиль</li></a>
    </ol>
   </li>
   <a href="knowledge/9.html" target="1">  <li>Горизонтальная панель</li></a>
   <a href="knowledge/10.html" target="1">  <li>Задачи</li></a>
</ol>
            </div>
            <div class="content">
                <iframe src="" name="1">
                
                </iframe> 
            </div>
        </div>
                <div class="footer">

    </div>
    </div>
    
</body>
</html>