<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$driver_fname = $_POST['driver_fname'];
$driver_lname = $_POST['driver_lname'];
$driver_contactNum = $_POST['driver_contactNum'];
$driver_address = $_POST['driver_address'];

$sql = "UPDATE driver SET driver_fname=?, driver_lname=?, driver_contactNum=?, driver_address=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $driver_fname, $driver_lname, $driver_contactNum, $driver_address, $id);

$stmt->execute();
$stmt->close();
$conn->close();

echo "<script>
            alert('Driver record updated successfully!');
            window.location.href = '../../Driver/view_driver.php';  // Correct path
         </script>";
exit();
