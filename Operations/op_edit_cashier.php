<?php
include "../Database/db_connect.php";

$id = $_POST['id'];
$cashier_fname = $_POST['cashier_fname'];
$cashier_lname = $_POST['cashier_lname'];
$cashier_contactNum = $_POST['cashier_contactNum'];
$cashier_address = $_POST['cashier_address'];
$casheir_username = $_POST['cashier_username'];
$casheir_password = $_POST['cashier_password'];

$sql = "UPDATE cashiers SET cashier_fname=?, cashier_lname=?, cashier_contactNum=?, cashier_address=?, username=?, password=? WHERE cashier_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $cashier_fname, $cashier_lname, $cashier_contactNum, $cashier_address, $casheir_username, $casheir_password, $id);

$stmt->execute();
$stmt->close();
$conn->close();

echo "<script>
            alert('Cashier record updated successfully!');
            window.location.href = '../../Cashier/view_cashier.php';  // Correct path
         </script>";
exit();
