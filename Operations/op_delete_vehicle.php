<?php
include "../Database/db_connect.php";

try {
    $id = $_GET['id'];

    $sql = "DELETE FROM vehicles WHERE vehicle_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../Vehicle/view_vehicle.php?success=1");
    exit();
} catch (\Exception $e) {
    $conn->close();
    die($e);
}
