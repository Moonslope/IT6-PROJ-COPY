<?php
include "../Database/db_connect.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    try {
        $platenumber = $_POST['platenumber'];
        $dd_driver = $_POST['dd-driver'];

        $sql = "INSERT INTO vehicle(platenumber) VALUES (?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $platenumber);

        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "<script>
      alert('Vehicle added successfully!');
      window.location.href = '../AdminUI/adminDashboard.php';
   </script>";
    } catch (\Exception $e) {

        $conn->close();
        die($e);
    }
}
