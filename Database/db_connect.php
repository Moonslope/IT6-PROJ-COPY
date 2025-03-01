<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "testl300";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
