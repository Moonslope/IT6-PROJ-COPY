<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   try {
      $card_color_id = $_POST['card_color_id'];
      $route_id = $_POST['route_id'];
      $driver_id = $_POST['driver_id'];
      $vehicle_id = $_POST['vehicle_id'];
      $cashier_id = $_POST['cashier_id'];

      $sql = "INSERT INTO travel_pass (driver_id, vehicle_id, cashier_id, card_color_id, total_passengers, total_fare, travel_date, route_id) 
   VALUES (?, ?, ?, ?, 0, 0.00, NOW(), ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("iiiii", $driver_id, $vehicle_id, $cashier_id, $card_color_id, $route_id);

      if ($stmt->execute()) {
         // Get the last inserted travel_pass_id
         $last_id = $conn->insert_id;

         header("Location: ../CashierUI/cashierUI.php?travel_pass_id=" . $last_id);
         exit();
      }

      $stmt->close();
      $conn->close();
   } catch (Exception $e) {
      $conn->close();
      die($e);
   }
}
