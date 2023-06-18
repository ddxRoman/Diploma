
<?php
// $search=$_POST['yandex'];
// echo "DJJJJ".$search;
// if($search!=" ") {
    // header('Location: https://yandex.ru/search/?text='.$search );
// }
// else{
// $search=$_POST["google"];
// if($search!=" "){
    

//     header('https://www.google.com/search?q='.$search);
    
// }
// else {
//     echo "NO";
// }
// } 



$search=$_POST['yandex'];
if($search!="") {
    header('Location: https://yandex.ru/search/?text='.$search);
}
else{
$search=$_POST['google'];
if($search!=""){
    

    header('Location: https://www.google.com/search?q='.$search);
    
}
else {
    header('Location: https://duckduckgo.com');
}
}