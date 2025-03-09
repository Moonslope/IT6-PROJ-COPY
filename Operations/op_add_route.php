<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $route_name = $_POST['route_name'];
      $origin = $_POST['origin'];
      $destination = $_POST['destination'];

      $sql = "INSERT INTO routes(route_name, route_origin, route_destination) VALUES (?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $route_name, $origin, $destination);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      header("Location: ../Route/add_route.php?success=1");
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
