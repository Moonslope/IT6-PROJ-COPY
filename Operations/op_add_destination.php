<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    try {
        if (isset($_POST['destination_name']) && !empty($_POST['destination_name'])) {
            $destination_name = $_POST['destination_name'];

            $sql = "INSERT INTO destination(destination_name, route_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $destination_name, $route_id);

            $stmt->execute();
            $stmt->close();
            $conn->close();

            // Redirect back with a success flag
            header("Location: ../Destination/view_destination.php?success=1");
            exit();
        } else {
            throw new Exception("Destination name is required.");
        }
    } catch (\Exception $e) {
        $conn->close();
        die($e->getMessage());
    }
}
