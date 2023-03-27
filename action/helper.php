<?php
$ticket=$_POST['ticket'];

if($ticket>0){
    header('Location: https://helper.bizonoff-dev.net/admin/projects/medcloud/boards/razrabotka-medklaud/tickets/'.$ticket);
}
else{
    header('Location: https://helper.bizonoff-dev.net/admin/projects/medcloud/boards/razrabotka-medklaud/?display=list&by_desc=true&create=true');
}
?>



