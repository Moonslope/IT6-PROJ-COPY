<?php
include "../Database/db_connect.php";

try {
   $id = $_GET['id'];

   $sql = "DELETE FROM route WHERE route_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $stmt->close();
   $conn->close();


   echo "<script>
            alert('Route record deleted successfully!');
            window.location.href = '../Route/view_route.php'; 
         </script>";
   exit();
} catch (\Exception $e) {
   $conn->close();
   die($e);
}
