<? require_once "../function/checkaut.php";
$page_id = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
</head>

<style>
    button {
  display: inline-block;
    width: 240px;              /* фиксированная ширина */
  height: 60px;              /* фиксированная высота */
  font-size: 16px;
  font-weight: 500;
  border: none;
  border-radius: 10px;
  padding: 12px 20px;
  margin: 10px 5px;
  cursor: pointer;
  transition: all 0.25s ease-in-out;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
}

button:hover {
  background: linear-gradient(135deg, #a0bee7ff, #e2e6ecff);
  transform: translateY(-2px);
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.25);
}

button:active {
  transform: translateY(0);
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

button:focus {
  outline: 2px solid #80bdff;
  outline-offset: 2px;
}

</style>

<body class="iframe-body">
    <div class="folders">
   <?
    require_once "../action/connect.php";
    foreach($site as $sites)
    {
        if($sites[3]==$page_id){
        ?><a href="<?=$sites[2]?>" target="_blank"><button class="docsFolders_btn"><?=$sites[1]?></button></a><?
        }
    }
    ?>
</div> 
</body>
</html>