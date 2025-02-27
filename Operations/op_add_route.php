<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $route = $_POST['route'];
      $fare = $_POST['fare'];

      $sql = "INSERT INTO route(route, fare) VALUES (?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $route, $fare);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      echo "<script>
      alert('Route added successfully!');
      window.location.href = '../Route/view_route.php';
   </script>";
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
