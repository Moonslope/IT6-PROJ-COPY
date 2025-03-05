<?php

include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $destination_id = $_POST['destination_id']; // Ensure this is sent from the form
   $route_name = $_POST['route'];
   $fare = $_POST['fare'];


   // Insert new route
   $sql = "INSERT INTO route (route, fare, destination_id) VALUES (?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("sdi", $route, $fare, $destination_id);
   $stmt->execute();

   if ($stmt->execute()) {
      $new_route_id = $stmt->insert_id; // Get the new route ID

      // Update the destination to associate it with the new route
      $update_query = "UPDATE destination SET route_id = ? WHERE destination_id = ?";
      $update_stmt = $conn->prepare($update_query);
      $update_stmt->bind_param("ii", $new_route_id, $destination_id);
      $update_stmt->execute();

      echo "Route added successfully!";
      header("Location: ../Destination/edit_destination.php?id=$destination_id");
      exit();
   } else {
      echo "Error adding route!";
   }
}
