<?php
include "../Database/db_connect.php";

try {
   $id = $_GET['id'];

   $sql = "DELETE FROM destinations WHERE destination_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $stmt->close();
   $conn->close();

   header("Location: view_route_point.php?success=2");
   exit();
} catch (\Exception $e) {
   $conn->close();
   die($e);
}
