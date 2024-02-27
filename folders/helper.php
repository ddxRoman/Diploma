<? require_once "../function/checkaut.php";?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
</head>
<body class="iframe-body">
<div class="helper">
<div class="helperSearch">
            
        <form target="_blank" action="../action/helper.php" method="post">
<input type="number" name="ticket" placeholder="Helper Ticket">
<a href="header.php"> 
    <button type="submit">GO</button>
</a>
</form>
<form target="_blank" action="../action/jiraСsd.php" method="post">
<label>Минусовое значение это SUP</label><br>
<input type="number" name="ticketJira"  placeholder="Jira Ticket">
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
        </div>



    </div>

</body>
</html>