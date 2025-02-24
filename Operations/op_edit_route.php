<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$route = $_POST['route'];
$fare = $_POST['fare'];

$sql = "UPDATE route SET route=?, fare=? WHERE route_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $route, $fare, $id);

$stmt->execute();
$stmt->close();
$conn->close();

echo "<script>
            alert('Route record updated successfully!');
            window.location.href = '../../Route/view_route.php';  // Correct path
         </script>";
exit();
