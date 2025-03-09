<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cocop";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
