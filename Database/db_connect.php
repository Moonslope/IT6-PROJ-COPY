<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "i6proj";

try {
   $conn = new mysqli($servername, $username, $password, $database);
} catch (\Exception $e) {
   die($e);
}
