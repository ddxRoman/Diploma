
              <!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Модальное окно на чистом CSS</title>
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-size: 16px;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      text-align: left;
      background-color: #fff;
    }

    .tabs {
      font-size: 0;
      max-width: 350px;
      margin-left: auto;
      margin-right: auto;
    }

    .tabs>input[type="radio"] {
      display: none;
    }

    .tabs>div {
      /* скрыть контент по умолчанию */
      display: none;
      border: 1px solid #e0e0e0;
      padding: 10px 15px;
      font-size: 16px;
    }

    /* отобразить контент, связанный с вабранной радиокнопкой (input type="radio") */
    #tab-btn-1:checked~#content-1,
    #tab-btn-2:checked~#content-2,
    #tab-btn-3:checked~#content-3 {
      display: block;
    }

    .tabs>label {
      display: inline-block;
      text-align: center;
      vertical-align: middle;
      user-select: none;
      background-color: #f5f5f5;
      border: 1px solid #e0e0e0;
      padding: 2px 8px;
      font-size: 16px;
      line-height: 1.5;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
      cursor: pointer;
      position: relative;
      top: 1px;
    }

    .tabs>label:not(:first-of-type) {
      border-left: none;
    }

    .tabs>input[type="radio"]:checked+label {
      background-color: #fff;
      border-bottom: 1px solid #fff;
    }
  </style>

</head>

<body>

  <div class="tabs">
    <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
    <label for="tab-btn-1">Вкладка 1</label>
    <input type="radio" name="tab-btn" id="tab-btn-2" value="">
    <label for="tab-btn-2">Вкладка 2</label>
    <input type="radio" name="tab-btn" id="tab-btn-3" value="">
    <label for="tab-btn-3">Вкладка 3</label>

    <div id="content-1">
    <div class="links">
                <form action="color.php" name="bg" method="post">
                <table>
<tr>
    <th>Select  background: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Select text color:</th>
    <th><input name="txtColor" type="color" value="<?=$text_color?>"><br></th>
</tr>
<tr>
    <th>Select button color:</th>
    <th><input name="btn_color" type="color" value="<?=$btn_color?>"><br></th>
</tr>
</table>
    <button>Применить</button>
    </form>

        </div>
    </div>
    <div id="content-2">
      Содержимое 2...
    </div>
    <div id="content-3">
      Содержимое 3...
    </div>
  </div>

</body>

</html>
			