<?php

use function PHPSTORM_META\sql_injection_subst;

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
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $user = $_POST['username'];
   $pass = $_POST['password'];

   $sql = "SELECT cashier_id, password FROM cashiers WHERE username=?";

   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $user);

   $stmt->execute();
   $stmt->store_result();
   $stmt->bind_result($user_id, $stored_password);
   $stmt->fetch();

   if ($pass === $stored_password) {
      $_SESSION["cashier_id"] == $user_id;
      echo "<script>
      alert('Login Successfully');
      window.location.href= '../CashierUI/travel_pass_history.php';
      </script>";
   } else {
      echo "<script>alert('Invalid credentials');
      window.location.href = '../Authentication/login.php';
      </script>";
   }

   $stmt->close();
   $conn->close();
}


   // // User login verification
   // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
   // $result = $conn->query($sql);

   // if ($result->num_rows == 1) {
   //    $_SESSION['username'] = $username;
   //    echo "<script>
   //             alert('Login successful!');
   //             window.location.href = '../CashierUI/cashierUI.php';
   //          </script>";
   //    exit();
   // } else {
   //    // Invalid login attempt
   //    echo "<script>
   //             alert('Invalid username or password!');
   //             window.location.href = 'Login.php';
   //          </script>";
   // }
