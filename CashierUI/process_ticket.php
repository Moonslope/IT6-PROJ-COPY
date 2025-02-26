<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $destination = $_POST["destination"];

   if (!empty($destination)) {
      // Fetch route_id and fare for the selected destination
      $sql = "SELECT route_id, fare FROM route WHERE route = ?";
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
         die("Error preparing statement: " . $conn->error);
      }

      $stmt->bind_param("s", $destination);
      $stmt->execute();
      $stmt->bind_result($route_id, $fare);
      $stmt->fetch();
      $stmt->close();

      if (!empty($route_id)) {
         // Check if the destination already exists in the temp_record table
         $checkSql = "SELECT total_passengers FROM temp_record WHERE route_id = ?";
         $checkStmt = $conn->prepare($checkSql);

         if (!$checkStmt) {
            die("Error preparing check statement: " . $conn->error);
         }

         $checkStmt->bind_param("i", $route_id);
         $checkStmt->execute();
         $checkStmt->bind_result($existing_passengers);
         $exists = $checkStmt->fetch();
         $checkStmt->close();

         if ($exists) {
            // Update the existing record: increment total_passengers and compute total_fare
            $new_total_passengers = $existing_passengers + 1;
            $new_total_fare = $new_total_passengers * $fare;

            $updateSql = "UPDATE temp_record SET total_passengers = ?, total_fare = ? WHERE route_id = ?";
            $updateStmt = $conn->prepare($updateSql);

            if (!$updateStmt) {
               die("Error preparing update statement: " . $conn->error);
            }

            $updateStmt->bind_param("idi", $new_total_passengers, $new_total_fare, $route_id);
            $updateStmt->execute();
            $updateStmt->close();
         } else {
            // Insert new temp_record entry
            $insertSql = "INSERT INTO temp_record (route_id, total_passengers, total_fare) VALUES (?, 1, ?)";
            $insertStmt = $conn->prepare($insertSql);

            if (!$insertStmt) {
               die("Error preparing insert statement: " . $conn->error);
            }

            $total_fare = $fare;
            $insertStmt->bind_param("id", $route_id, $total_fare);
            $insertStmt->execute();
            $insertStmt->close();
         }
      } else {
         die("No matching route found for: " . $destination);
      }
   }

   header("Location: cashierUI.php");
   exit();
}
