<?php
include "../Database/db_connect.php";

if (isset($_POST['vehicle_id'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $sql = "SELECT d.driver_name FROM vehicle v JOIN driver d ON d.driver_id WHERE v.vehicle_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['driver_name'];
    } else {
        echo "No driver found";
    }
    $stmt->close();
    $conn->close();
}
