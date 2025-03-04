<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "copy_3dots";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
