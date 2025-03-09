<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$platenumber = $_POST['platenumber'];
$driver_id = $_POST['driver_id'];
$vehicle_model = $_POST['vehicle_model'];
$transmission_type = $_POST['transmission_type'];
$vehicle_color = $_POST['vehicle_color'];

//Check if the driver is already assigned to another vehicle
$sql_check = "SELECT * FROM vehicles WHERE driver_id = ? AND vehicle_id != ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $driver_id, $id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$stmt_check->close();

if ($result_check->num_rows > 0) {
   echo "<script>
            window.location.href = '../Vehicle/edit_vehicle.php?id=$id&error=" . urlencode("This driver is already assigned to another vehicle. Please select another driver.") . "';
         </script>";
   exit();
}

//Get driver name
$sql_get_driver = "SELECT driver_name FROM drivers WHERE driver_id = ?";
$stmt_driver = $conn->prepare($sql_get_driver);
$stmt_driver->bind_param("i", $driver_id);
$stmt_driver->execute();
$result_driver = $stmt_driver->get_result();
$row_driver = $result_driver->fetch_assoc();
$stmt_driver->close();
$driver_name = $row_driver['driver_name']; // Get driver name

//Update the vehicle record
$sql_update = "UPDATE vehicles 
               SET driver_id = ?, driver = ?, platenumber = ?, vehicle_model = ?, transmission_type = ?, vehicle_color = ? 
               WHERE vehicle_id = ?";
$stmt_update = $conn->prepare($sql_update);

if ($stmt_update) {
   $stmt_update->bind_param("isssssi", $driver_id, $driver_name, $platenumber, $vehicle_model, $transmission_type, $vehicle_color, $id);

   if ($stmt_update->execute()) {
      echo "<script>
            window.location.href = '../Vehicle/edit_vehicle.php?id=$id&success=" . urlencode("Vehicle record updated successfully!") . "';
         </script>";
      exit();
   }

   $stmt_update->close();
} else {
   echo "<script>alert('Error preparing statement');</script>";
}

$conn->close();
exit();
