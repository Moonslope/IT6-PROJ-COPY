<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Validate input
   if (!isset($_POST['destination']) || empty($_POST['destination'])) {
      die("Error: Destination is required.");
   }

   $destination_id = $_POST['destination'];

   // Fetch the fare for the selected destination
   $query = "SELECT fare FROM destinations WHERE destination_id = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $destination_id);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($row = $result->fetch_assoc()) {
      $fare = $row['fare'];
   } else {
      die("Error: Invalid destination selected.");
   }

   // Get the latest travel pass ID
   $query = "SELECT travel_pass_id FROM travel_pass ORDER BY travel_date DESC LIMIT 1";
   $result = $conn->query($query);
   if ($row = $result->fetch_assoc()) {
      $travel_pass_id = $row['travel_pass_id'];
   } else {
      die("Error: No active travel pass found.");
   }

   // Insert into passenger_destination table
   $query = "INSERT INTO passenger_destination (travel_pass_id, destination_id, fare, passenger_count) VALUES (?, ?, ?, 1)";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("iid", $travel_pass_id, $destination_id, $fare);

   if ($stmt->execute()) {

      header("Location: cashierUI.php?travel_pass_id=" . $travel_pass_id);
      exit();
   } else {
      die("Error: Unable to process ticket. " . $stmt->error);
   }
} else {
   die("Invalid request.");
}
