<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $driver_fname = $_POST['driver_fname'];
      $driver_lname = $_POST['driver_lname'];
      $driver_address = $_POST['driver_address'];
      $driver_contactNum = $_POST['driver_contactNum'];

      $sql = "INSERT INTO driver(driver_fname, driver_lname, driver_address, driver_contactNum) VALUES (?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $driver_fname, $driver_lname, $driver_address, $driver_contactNum);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      echo "<script>
      alert('Driver added successfully!');
      window.location.href = '../AdminUI/adminDashboard.php';
   </script>";
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
