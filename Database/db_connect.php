<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "3dots_db";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
