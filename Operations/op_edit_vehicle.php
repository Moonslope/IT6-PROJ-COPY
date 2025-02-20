<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$platenumber = $_POST['platenumber'];

$sql = "UPDATE vehicle SET platenumber=? WHERE vehicle_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $platenumber, $id);

$stmt->execute();
$stmt->close();
$conn->close();

echo "<script>
            alert('Vehicle record updated successfully!');
            window.location.href = '../../Vehicle/view_vehicle.php';  // Correct path
         </script>";
exit();
