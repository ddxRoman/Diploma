<? 
require_once "../function/checkaut.php";
require_once "../action/connect.php";
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>
<body class="iframe-body">
<div class="helper">
<div class="helperSearch">
            
        <form target="_blank" action="../action/helper.php" method="post">
<input type="number" name="ticket" placeholder="MEDSUP">
<a href="header.php"> 
    <button type="submit">GO</button>
</a>
</form>
<form target="_blank" action="../action/jiraСsd.php" method="post">
<label>Минусовое значение это SUP</label><br>
<input type="number" name="ticketJira"  placeholder="MEDRWK">
<a href="jiraСsd.php"> 
    <button type="submit">GO</button>
</a>
</form>
        </div>
    <div class="link">
<a href="https://jira.csd.com.ua/secure/Tempo.jspa#/my-work"
        target="_blank"><button>TEMPO</button></a>
    <a href="https://helper.bizonoff-dev.net/admin/projects/medcloud/knowledge-bases/dokumentatsiia-funktsionala"
        target="_blank"><button>Helper</button></a>
        <a href="https://docs.google.com/spreadsheets/d/1sjEopcZ5WOQyIz3S4ChNKx26nIP4iKaXx15vWqIn_rA/edit?gid=2048374952#gid=2048374952"
        target="_blank"><button>Daily</button></a>
        </div>

        <table>
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>

    <?
 foreach($helper_log as $helper_logs) { 

        ?>
    <tr>
      <td>
        <a href="<?=$helper_logs[2]?>" target="_blank">
            <?=$helper_logs[1]?>
        </a>
        </td>
      <td><?=$helper_logs[3]?></td>

    </tr>
    <?}?>
  </tbody>
</table>
    </div>

</body>
</html>