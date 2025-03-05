<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination_id = $_POST['destination_id'];
    $destination_name = $_POST['destination_name'];
    $route_id = $_POST['route_id'];

    // Update the destination with the selected route
    $query = "UPDATE destination SET destination_name = ?, route_id = ? WHERE destination_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $destination_name, $route_id, $destination_id);

    if ($stmt->execute()) {
        echo "Destination updated successfully!";
        header("Location: view_destination.php"); // Redirect to the destination list
        exit();
    } else {
        echo "Error updating destination!";
    }
}
