<?php
include "../Database/db_connect.php";

if (!isset($_GET['travel_pass_id'])) {
   die("Error: No travel_pass_id received.");
}

$travel_pass_id = $_GET['travel_pass_id'];

//Get the route_id from travel_pass
$route_query = $conn->prepare("SELECT route_id FROM travel_pass WHERE travel_pass_id = ?");
$route_query->bind_param("i", $travel_pass_id);
$route_query->execute();
$route_result = $route_query->get_result();

if ($route_result->num_rows === 0) {
   die("Error: No route found for this travel pass.");
}

$route_row = $route_result->fetch_assoc();
$route_id = $route_row['route_id'];

//Fetch destinations for that route
$dest_query = $conn->prepare("SELECT destination_id, destination_name FROM destinations WHERE route_id = ?");
$dest_query->bind_param("i", $route_id);
$dest_query->execute();
$dest_result = $dest_query->get_result();

//Generate dropdown options
$options = '<option value="">None</option>';
while ($row = $dest_result->fetch_assoc()) {
   $options .= '<option value="' . $row['destination_id'] . '">' . $row['destination_name'] . '</option>';
}

echo $options;
