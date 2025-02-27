<?php
include "../Database/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // Check if the username already exists
   $checkUser = "SELECT * FROM users WHERE username = '$username'";
   $result = $conn->query($checkUser);

   if ($result->num_rows > 0) {
      // Username already taken
      echo "<script>
               alert('Username already taken!');
               window.location.href = 'Register.php';
            </script>";
   } else {
      // Insert the new user
      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
      if ($conn->query($sql) === TRUE) {
         // Registration successful
         echo "<script>
                  alert('Registration successful!');
                  window.location.href = 'Login.php';
               </script>";
      } else {
         // Error during registration
         echo "<script>
                  alert('Error during registration. Please try again.');
                  window.location.href = 'Register.php';
               </script>";
      }
   }
}
