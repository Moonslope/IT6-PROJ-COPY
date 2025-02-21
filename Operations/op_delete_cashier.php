<?php
include "../Database/db_connect.php";

try {
   $id = $_GET['id'];

   $sql = "DELETE FROM cashier WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $stmt->close();
   $conn->close();


   echo "<script>
            alert('Cashier record deleted successfully!');
            window.location.href = '../Cashier/view_cashier.php'; 
         </script>";
   exit();
} catch (\Exception $e) {
   $conn->close();
   die($e);
}
