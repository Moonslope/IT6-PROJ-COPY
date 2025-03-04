<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $cashier_fname = $_POST['cashier_fname'];
      $cashier_lname = $_POST['cashier_lname'];
      $cashier_address = $_POST['cashier_address'];
      $cashier_contactNum = $_POST['cashier_contactNum'];

      $sql = "INSERT INTO cashiers(cashier_fname, cashier_lname, cashier_address, cashier_contactNum) VALUES (?,?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $cashier_fname, $cashier_lname, $cashier_address, $cashier_contactNum);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      // Redirect back with a success flag
      header("Location: ../Cashier/add_cashier.php?success=1");
      exit();
   } catch (\Exception $e) {
      $conn->close();
      die($e);
   }
}
