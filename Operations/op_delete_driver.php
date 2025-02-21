<?php
include "../Database/db_connect.php";

try {
    $id = $_GET['id'];

    $sql = "DELETE FROM driver WHERE driver_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();


    echo "<script>
            alert('Driver record deleted successfully!');
            window.location.href = '../Driver/view_driver.php'; 
         </script>";
    exit();
} catch (\Exception $e) {
    $conn->close();
    die($e);
}
