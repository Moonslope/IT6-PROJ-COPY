<?php
include "../Database/db_connect.php";

$sql = "SELECT total_sales_today, total_sales_month FROM sales_summary";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
   echo json_encode($row); // Send data as JSON
} else {
   echo json_encode(["total_sales_today" => 0, "total_sales_month" => 0]);
}

$conn->close();
