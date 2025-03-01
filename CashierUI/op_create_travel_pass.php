<?php
include "../Database/db_connect.php";

$card_id = $_POST['card_id'];
$route_id = $_POST['route_id'];
$driver_id = $_POST['driver_id'];
$vehicle_id = $_POST['vehicle_id'];
$cashier_id = $_POST['cashier_id'];

// Check if any field is empty
if (empty($card_id) || empty($route_id) || empty($driver_id) || empty($vehicle_id) || empty($cashier_id)) {
   die("Error: Please fill in all fields.");
}

// Create a new travel pass
$stmt = $conn->prepare("INSERT INTO travel_pass 
                        (driver_id, vehicle_id, cashier_id, card_id, total_passengers, total_fare, travel_date, route_id) 
                        VALUES (?, ?, ?, ?, 0, 0.00, NOW(), ?)");
if (!$stmt) {
   die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("iiiii", $driver_id, $vehicle_id, $cashier_id, $card_id, $route_id);

if ($stmt->execute()) {
   // Get the last inserted travel_pass_id
   $last_id = $conn->insert_id;

   header("Location: ../CashierUI/cashierUI.php?travel_pass_id=" . $last_id);
   exit();
}

$stmt->close();
$conn->close();
