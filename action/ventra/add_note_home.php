<?
require_once '../connect.php';
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

echo $street."УЦлица - ".$build."Дом - ".$competitors."Ключи - ".$door_key."Адрес ИД - ".$adress_id;


mysqli_query($connect, "INSERT INTO `ventra_home_notefication` (`id`, `adress_id`, `note`, `door_key`, `competitors`)
        VALUES (NULL, '$adress_id', '$note','$door_key','$competitors'  )");
header("Location: ../../folders/ventra/current_home.php?street=" . urlencode($street) . "&build=" . urlencode($build));
exit;


?>