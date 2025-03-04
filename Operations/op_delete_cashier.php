<?php
include "../Database/db_connect.php";

try {
   $id = $_GET['id'];

   $sql = "DELETE FROM cashiers WHERE cashier_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $stmt->close();
   $conn->close();

   header("Location: ../Cashier/view_cashier.php?success=1");
   exit();
} catch (\Exception $e) {
   $conn->close();
   die($e);
}
