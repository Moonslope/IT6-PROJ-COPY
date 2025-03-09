<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$route_name = $_POST['route_name'];
$origin = $_POST['origin'];
$destination = $_POST['destination'];

$sql = "UPDATE routes SET route_name=?, route_origin=?, route_destination=? WHERE route_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $route_name, $origin, $destination, $id);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: ../Route/view_route.php?update=1");
exit();
