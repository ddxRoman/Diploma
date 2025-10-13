<?php
require_once "../connect.php";

$visit_id = $_GET['id'];
$adress_id = $_GET['adress_id'];



if ($visit_id && $adress_id) {
    $stmt = $connect->prepare("DELETE FROM visit_home_date WHERE id = ?");
    $stmt->bind_param("i", $visit_id);
    $stmt->execute();
}


$stmt = $connect->prepare("SELECT street, build FROM ventra_home WHERE id = ?");
$stmt->bind_param("i", $adress_id);
$stmt->execute();
$result = $stmt->get_result();
$home = $result->fetch_assoc();

if (!$home) {
    die("Ошибка: дом с таким ID не найден");
}

$street = $home['street'];
$build  = $home['build'];

echo"TYT - ". $street;




header("Location: ../../folders/ventra/current_home.php?street=" . urlencode($street). "&build=" . urlencode($build));
exit();
?>
