<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $route_id = $_POST['route'];
      $route_point_name = $_POST['route_point_name'];
      $fare = $_POST['fare'];

      $sql = "INSERT INTO destinations (destination_name, fare ,route_id) VALUES (?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssi", $route_point_name, $fare, $route_id);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      header("Location: add_route_point.php?success=1");
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
