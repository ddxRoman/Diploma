
<?php
$num=$_POST['rwk'];
if($num>0) {
    header('Location: https://client'.$num.'.lab.helsi.pro/');
}
else{
$num=$_POST['sup'];
if($num>0){
    

    header('Location: https://miswiki.atlassian.net/browse/LAB-'.$num);
    
}
else {
    header('Location: https://miswiki.atlassian.net/jira/software/c/projects/LAB/issues/?jql=project%20%3D%20%22LAB%22%20AND%20reporter%20%3D%20currentUser%28%29%20ORDER%20BY%20created%20DESC');
}
}