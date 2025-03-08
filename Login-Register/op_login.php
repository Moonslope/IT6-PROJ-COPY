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

   // Fetch cashier details (including cashier_name)
   $sql = "SELECT cashier_id, cashier_name, password FROM cashiers WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->store_result();
   $stmt->bind_result($cashier_id, $cashier_name, $stored_password);
   $stmt->fetch();

   if ($password === $stored_password) {
      // Store both cashier_id and cashier_name in session
      $_SESSION["cashier_id"] = $cashier_id;
      $_SESSION["cashier_name"] = $cashier_name;

      echo "<script>
      alert('Login Successfully');
      window.location.href= '../CashierUI/travel_pass_history.php';
      </script>";
   } else {
      echo "<script>alert('Invalid credentials');
      window.location.href = '../Login-Register/login.php';
      </script>";
   }

   $stmt->close();
   $conn->close();
}
