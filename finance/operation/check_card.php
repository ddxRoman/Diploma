<?
$summa=0;
foreach($finance as $finances){
if ($finances[7]=='Shared') $summa=$summa+$finances[4];

if($finances[5]=='Рома' && $month==$select_month && $yaer==$select_year) {echo "try";}
// echo 'Date - '. $select_month.''.$select_year.'<br>';
}

?>