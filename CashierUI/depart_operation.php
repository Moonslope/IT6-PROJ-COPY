<?php
include "../Database/db_connect.php";

// Check if the form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $driver_id = $_POST['driver_id'];
   $vehicle_id = $_POST['vehicle_id'];
   $cashier_id = $_POST['cashier_id'];
   $card_id = $_POST['card_id'];
   $total_passengers = $_POST['total_passengers'];
   $total_fare = $_POST['total_fare'];
   $travel_date = date('Y-m-d'); // Current date
   $departure_time = date('H:i:s'); // Current time

   $stmt = $conn->prepare("INSERT INTO travel_pass (driver_id, vehicle_id, cashier_id, card_id, total_passengers, total_fare, travel_date, departure_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

   if ($stmt) {
      $stmt->bind_param("iiiidiss", $driver_id, $vehicle_id, $cashier_id, $card_id, $total_passengers, $total_fare, $travel_date, $departure_time);

      if ($stmt->execute()) {
         // Clear the ticket table after successful departure
         $deleteTickets = "DELETE FROM temp_record";
         if ($conn->query($deleteTickets) === TRUE) {
            echo "<script>alert('Travel pass recorded successfully!'); window.location.href='cashierUI.php';</script>";
            exit();
         } else {
            echo "Error clearing tickets: " . $conn->error;
         }
      } else {
         echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
   } else {
      echo "Failed to prepare statement: " . $conn->error;
   }

   $conn->close();
} else {
   echo "Invalid request method.";
}
