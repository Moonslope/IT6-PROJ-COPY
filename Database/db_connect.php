<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "it6_caltransco_db";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
