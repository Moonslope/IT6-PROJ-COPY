<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$route_id = $_POST['route'];
$destination_name = $_POST['destination_name'];
$fare = $_POST['fare'];

$sql = "UPDATE destinations SET destination_name = ?, fare = ?, route_id = ?  WHERE destination_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdii", $destination_name, $fare, $route_id, $id);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: view_route_point.php?");
exit();
