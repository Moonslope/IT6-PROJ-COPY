<?php
include "../Database/db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $travel_pass_id = $_POST['travel_pass_id'];

   // Get the current time
   date_default_timezone_set('Asia/Manila');
   $departure_time = date("Y-m-d h:i:s A"); // 12-hour format

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
