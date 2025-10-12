<?
require_once '../connect.php';
$check=0;
$competitors = isset($_POST['competitors']) ? implode(', ', $_POST['competitors']) : '';

$street = $_GET['street'];
$build = $_GET['build'];


$door_key = isset($_POST['keys']) ? implode(', ', $_POST['keys']) : '';
$note = $_POST['note'];

$sql = "SELECT id FROM ventra_home WHERE street = ? AND build = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$adress_id=$row['id'];

foreach ($ventra_note as $ventra_notes){
        if($ventra_notes[1] == $adress_id){
                $check = 1;
                echo $ventra_notes[1];
        }

}
if ($check==0){
        echo "If ".$check. " - ".$adress_id ;
mysqli_query($connect, "INSERT INTO `ventra_home_notefication` (`id`, `adress_id`, `note`, `door_key`, `competitors`)
        VALUES (NULL, '$adress_id', '$note','$door_key','$competitors'  )");
header("Location: ../../folders/ventra/current_home.php?street=" . urlencode($street) . "&build=" . urlencode($build));
} else {
        echo "else";
mysqli_query($connect, "UPDATE `ventra_home_notefication` SET  `note` = '$note', `door_key` = '$door_key', `competitors`= '$competitors' WHERE `adress_id` = '$adress_id'");
header("Location: ../../folders/ventra/current_home.php?street=" . urlencode($street) . "&build=" . urlencode($build));


}




exit;


?>