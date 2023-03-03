<?php
$servername = "localhost";
$username = "mytouristaadmin";
$password = "CONTROLLer1000";


$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully to my tourist";


?>