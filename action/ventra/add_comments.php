<?
require_once '../connect.php';
$street = $_GET['street'];
$build = $_GET['build'];
$comment = $_POST['comment'];

echo $street."----".$build."<br>".$comment;


$sql = "SELECT id FROM ventra_home WHERE street = ? AND build = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ss", $street, $build);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$adress_id=$row['id'];


mysqli_query($connect, "INSERT INTO `ventra_builds_comment` (`id`, `comments`, `adress_id`, `date`)
        VALUES (NULL, '$comment', '$adress_id', NOW() )");
header("Location: ../../folders/ventra/current_home.php?street=" . urlencode($street) . "&build=" . urlencode($build));
exit;


?>