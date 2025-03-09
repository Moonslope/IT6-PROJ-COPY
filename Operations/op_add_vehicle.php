<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    try {
        $platenumber = $_POST['platenumber'];
        $vehicle_model = $_POST['vehicle_model'];
        $transmission_type = $_POST['transmission_type'];
        $vehicle_color = $_POST['vehicle_color'];


        $sql = "INSERT INTO vehicles(platenumber,vehicle_model,transmission_type,vehicle_color) VALUES (?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $platenumber, $vehicle_model, $transmission_type, $vehicle_color);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: ../Vehicle/add_vehicle.php?success=1");
        exit();
    } catch (\Exception $e) {

        $conn->close();
        die($e);
    }
}
