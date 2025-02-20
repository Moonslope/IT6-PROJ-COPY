<?php
include "../Database/db_connect.php";

try {
    $id = $_GET['id'];

    $sql = "DELETE FROM vehicle WHERE vehicle_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();


    echo "<script>
            alert('Vehicle record deleted successfully!');
            window.location.href = '../Vehicle/view_vehicle.php'; 
         </script>";
    exit();
} catch (\Exception $e) {
    $conn->close();
    die($e);
}
