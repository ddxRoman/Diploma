
              <!doctype html>
<html lang="ru">

<head>
  <title>jQuery - Метод replaceWith (пример)</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>

  <div style="margin: 50px;">
    <div class="info">
      <button class="info__add">Добавить кнопку</button>
    </div>
  </div>

  <!-- jQuery -->
  <script src="/examples/vendors/jquery/jquery-3.4.1.min.js"></script>

  <script>
       
    $('.info__add').click(function () {
        name= prompt('Введите название кнопки: ', ['Новая кнопка']);
      $(this).parent().append($('<button>', {
        'text': name, 'href': 'index.php'
      }));
    });
  </script>


</body>

</html>
						

<!-- Закрывашка сообщейни-->

<!doctype html>
<html lang="ru">

<head>
  <title>jQuery - Метод replaceWith (пример)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style>
    .message {
      margin: 10px;
      padding: 10px;
      border: 1px solid black;
      background-color: wheat;
    }

    .message__text {
      margin-bottom: 8px;
    }
  </style>
</head>

<body>

  <div style="margin: 50px;">
    <div class="message">
      <div class="message__text">Текст сообщения...</div>
    </div>
    <div class="message">
      <div class="message__text">Текст сообщения...</div>
    </div>
    <div class="message">
      <div class="message__text">Текст сообщения...</div>
    </div>
    <br>
    <button id="after">Добавить кнопку закрыть после текста сообщения</button>
  </div>

  <!-- jQuery -->
  <script src="/examples/vendors/jquery/jquery-3.4.1.min.js"></script>

  <script>
    $('#after').click(function () {
      $('.message__text').after($('<button>', {
        class: 'close',
        text: 'Закрыть сообщение'
      }));
      $(this).remove();
    });

    $(document).on('click', '.close', function () {
      $(this).parent().remove();
    });
  </script>


</body>

</html>
					