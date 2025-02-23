<?php
session_start();
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // Admin login
   if ($username == "admin" && $password == "admin") {
      $_SESSION['username'] = $username;
      echo "<script>
               alert('Admin login successful!');
               window.location.href = '../AdminUI/adminDashboard.php';
            </script>";
      exit();
   }

   // User login verification
   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
   $result = $conn->query($sql);

   if ($result->num_rows == 1) {
      $_SESSION['username'] = $username;
      echo "<script>
               alert('Login successful!');
               window.location.href = '../CashierUI/cashierUI.php';
            </script>";
      exit();
   } else {
      // Invalid login attempt
      echo "<script>
               alert('Invalid username or password!');
               window.location.href = 'Login.php';
            </script>";
   }
}
