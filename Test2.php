
              <!doctype html>
<html lang="ru">

<head>
  <title>jQuery - Метод replaceWith (пример)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <style>
    p, .new {
      margin: 5px;
      border: 1px solid black;
    }

    p {
      background-color: yellow;
    }

    .new {
      background-color: pink;
    }
  </style>
</head>

<body>


  <div style="margin: 50px;">
  <form action="#" method="post">
  <p>К чему я стремлюсь?</p>
    <br>
    <textarea name="txt">
    </textarea>    <br>
    <button>Вставить </button>
    </form>  
    <br>
    <br>
    <?php $txt=$_POST['txt'];?>
  </div>


  <!-- jQuery -->
  <script src="/examples/vendors/jquery/jquery-3.4.1.min.js"></script>

  <script>
    $('button').click(function () {
      $('<div class="new"><?= $txt ?></div>').insertAfter('p');
    })
  </script>


</body>

</html>
						