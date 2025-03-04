<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Validate input
   if (!isset($_POST['route_point']) || empty($_POST['route_point'])) {
      die("Error: Route point is required.");
   }

   if (!isset($_POST['passenger_count']) || empty($_POST['passenger_count'])) {
      die("Error: Passenger count is required.");
   }

   $route_point_id = $_POST['route_point'];
   $passenger_count = intval($_POST['passenger_count']);

   // Fetch the fare and route_id for the selected route_point
   $query = "SELECT fare, route_id FROM route_points WHERE route_point_id = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("i", $route_point_id);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($row = $result->fetch_assoc()) {
      $fare = $row['fare'];
      $route_id = $row['route_id'];
   } else {
      die("Error: Invalid route point selected.");
   }

   // Get the latest travel pass ID
   $query = "SELECT travel_pass_id FROM travel_pass ORDER BY travel_date DESC LIMIT 1";
   $result = $conn->query($query);
   if ($row = $result->fetch_assoc()) {
      $travel_pass_id = $row['travel_pass_id'];
   } else {
      die("Error: No active travel pass found.");
   }

   // Check if the route_point_id already exists in the travel pass
   $query = "SELECT passenger_count FROM route_route_points 
              WHERE route_id = ? AND route_point_id = ? AND travel_pass_id = ?";
   $stmt = $conn->prepare($query);
   $stmt->bind_param("iii", $route_id, $route_point_id, $travel_pass_id);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($row = $result->fetch_assoc()) {
      // Update passenger count if route_point_id already exists
      $new_passenger_count = $row['passenger_count'] + $passenger_count;
      $update_query = "UPDATE route_route_points 
                         SET passenger_count = ? 
                         WHERE route_id = ? AND route_point_id = ? AND travel_pass_id = ?";
      $update_stmt = $conn->prepare($update_query);
      $update_stmt->bind_param("iiii", $new_passenger_count, $route_id, $route_point_id, $travel_pass_id);

      if ($update_stmt->execute()) {
         header("Location: cashierUI.php?travel_pass_id=" . $travel_pass_id);
         exit();
      } else {
         die("Error: Unable to update passenger count. " . $update_stmt->error);
      }
   } else {
      // Insert new entry if not
      $insert_query = "INSERT INTO route_route_points (route_id, route_point_id, passenger_count, fare, travel_pass_id) 
                         VALUES (?, ?, ?, ?, ?)";
      $insert_stmt = $conn->prepare($insert_query);
      $insert_stmt->bind_param("iiidi", $route_id, $route_point_id, $passenger_count, $fare, $travel_pass_id);

      if ($insert_stmt->execute()) {
         header("Location: cashierUI.php?travel_pass_id=" . $travel_pass_id);
         exit();
      } else {
         die("Error: Unable to process ticket. " . $insert_stmt->error);
      }
   }
} else {
   die("Invalid request.");
}
