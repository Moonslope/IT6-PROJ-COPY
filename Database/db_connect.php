<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "l300_copy1";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
