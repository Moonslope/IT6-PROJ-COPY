<?php
include "../Database/db_connect.php";

if (isset($_POST['vehicle_id'])) {
    $vehicle_id = $_POST['vehicle_id'];
    $sql = "SELECT d.driver_id, d.driver_name FROM vehicles v JOIN drivers d ON v.driver_id = d.driver_id WHERE v.vehicle_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['driver_id' => $row['driver_id'], 'driver_name' => $row['driver_name']]);
    } else {
        echo json_encode(['driver_id' => null, 'driver_name' => 'No driver found']);
    }
    $stmt->close();
    $conn->close();
}
