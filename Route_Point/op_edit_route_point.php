<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$route_id = $_POST['route'];
$route_point_name = $_POST['route_point_name'];
$fare = $_POST['fare'];

$sql = "UPDATE route_points SET route_point_name = ?, fare = ?, route_id = ?  WHERE route_point_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdii", $route_point_name, $fare, $route_id, $id);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: view_route_point.php?update=1");
exit();
