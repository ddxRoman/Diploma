<!DOCTYPE html>
<html lang="en">
<head>
    <script>

        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')
        
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
        </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="trekerStyle.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">

            <div class="col-4">

<table class="fast-static">
    <tr><td>Встречи<td>5</td></td></tr>
    <tr><td>Токены<td>4</td></td></tr>
    <tr><td>Статистика<td>15</td></td></tr>
    <tr><td>Согласование<td>45</td></td></tr>
</table>
        
    </div>
            <div class="col-4">              
                  <? 
                //   require_once "../action/profileindex.php"; 
                  ?> 
        </div>

                <div class="col-4">
                <button type="button" class="btn_add_time" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Добавить Время
</button>

                </div>
                </div>     
            </div>
        </header>
<main>
<section class="btn_treker">

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Что зайка сделала?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form class="trekerForm" action="treakerController.php" method="post">
        <select name="type_work" >
        <option class="placeholder_label" value="" disabled selected hidden>Тип работы</option>
        <option value="meet">Встречи</option>
        <option value="token">Токены</option>
        <option value="statistics">Статистика</option>
        <option value="confirm">Согласование</option>
    </select><br>
        <select name="type_work" >
        <option class="placeholder_label" value="" disabled selected hidden>Юнит</option>
        <option value="meet">InComm</option>
        <option value="token">Rookee</option>
        <option value="statistics">Perfom</option>
        <option value="confirm">Organic</option>
    </select><br>
    <textarea name="comments_work" placeholder="Комментарий к работе"></textarea><br>
    <input type="date" placeholder="Дата"><br>
    <input type="number" required placeholder="Время"><br>

    
    <h1 id="timer">00:00:00</h1>
  <button id="startBtn">Старт</button>
  <button id="pauseBtn" disabled>Пауза</button>
  <button id="resetBtn" disabled>Сброс</button>

  
  <script src="stopwatch.js"></script>



    <button class="btn_save_modal">Сохранить</button>
</form>
</div>
    </div>
  </div>
</div>
</section>
<section class="section_table_treek">
    <table class="full-track">
        <tr>
            <th>
                Тип работы
        </th>
        <th>
                Комментарий
        </th>
        </tr>
    <tr>        <td class="type_work">            {Вид работы}        </td><td class="comments_work">            {Комментарий к работе}        </td>
    </tr>
    </tr>
    </table>
</section>

</main>
</body>
</html>