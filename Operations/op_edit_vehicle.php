<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$platenumber = $_POST['platenumber'];
$driver = $_POST['driver'];
$vehicle_model = $_POST['vehicle_model'];
$transmission_type = $_POST['transmission_type'];
$vehicle_color = $_POST['vehicle_color'];

// Ensure $id is an integer (if applicable)
$id = intval($id);

$sql = "UPDATE vehicle SET platenumber = ?, driver = ?, vehicle_model = ?, transmission_type = ?, vehicle_color = ? WHERE vehicle_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
   // Bind parameters correctly (assuming vehicle_id is an integer)
   $stmt->bind_param("sssssi", $platenumber, $driver, $vehicle_model, $transmission_type, $vehicle_color, $id);

   if ($stmt->execute()) {
      echo "<script>
                alert('Vehicle record updated successfully!');
                window.location.href = '../../Vehicle/view_vehicle.php';
              </script>";
   } else {
      echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
   }

   $stmt->close();
} else {
   echo "<script>alert('Error preparing statement');</script>";
}

$conn->close();
exit();
