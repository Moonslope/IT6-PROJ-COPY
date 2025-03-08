<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Get the latest travel pass ID
   $query = "SELECT travel_pass_id FROM travel_pass ORDER BY travel_date DESC LIMIT 1";
   $result = $conn->query($query);

   if ($row = $result->fetch_assoc()) {
      $travel_pass_id = $row['travel_pass_id'];
   } else {
      die("Error: No active travel pass found.");
   }

   // Get the current time
   $departure_time = date("Y-m-d H:i:s");

   // Update the travel_pass table with the departure time
   $query = "UPDATE travel_pass SET departure_time = ? WHERE travel_pass_id = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("si", $departure_time, $travel_pass_id);

   if ($stmt->execute()) {

      header("Location: travel_pass_history.php?success=1");
      exit();
   } else {
      die("Error: Unable to update departure time. " . $stmt->error);
   }
} else {
   die("Invalid request.");
}
