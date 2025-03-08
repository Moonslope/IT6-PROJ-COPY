<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $driver_fname = $_POST['driver_fname'];
      $driver_lname = $_POST['driver_lname'];
      $driver_address = $_POST['driver_address'];
      $driver_contactNum = $_POST['driver_contactNum'];

      $sql = "INSERT INTO drivers(driver_fname, driver_lname, driver_address, driver_contactNum) VALUES (?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $driver_fname, $driver_lname, $driver_address, $driver_contactNum);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      header("Location: ../Driver/add_driver.php?success=1");
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
