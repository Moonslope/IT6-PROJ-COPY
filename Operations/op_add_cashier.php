<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
   try {
      $cashier_fname = $_POST['cashier_fname'];
      $cashier_lname = $_POST['cashier_lname'];
      $cashier_address = $_POST['cashier_address'];
      $cashier_contactNum = $_POST['cashier_contactNum'];

      $sql = "INSERT INTO cashier(cashier_fname, cashier_lname, cashier_address, cashier_contactNum) VALUES (?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $cashier_fname, $cashier_lname, $cashier_address, $cashier_contactNum);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      echo "<script>
      alert('Cashier added successfully!');
      window.location.href = '../Cashier/view_cashier.php';
   </script>";
   } catch (\Exception $e) {

      $conn->close();
      die($e);
   }
}
