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

// Check if the driver is already assigned to another vehicle
$sql_check = "SELECT * FROM vehicles WHERE driver_id = (SELECT driver_id FROM drivers WHERE driver_name = ?) AND vehicle_id != ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("si", $driver, $id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
   echo "<script>
            alert('This driver is already assigned to another vehicle.');
            window.location.href = '../../Vehicle/edit_vehicle.php?id=$id';
          </script>";
} else {
   $sql = "UPDATE vehicles SET platenumber = ?, driver = ?, vehicle_model = ?, transmission_type = ?, vehicle_color = ? WHERE vehicle_id = ?";
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
}

$conn->close();
exit();
