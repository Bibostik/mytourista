<?php
// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Connect to the database
require_once 'config.php';

// Insert the user data into the appropriate table
if ($role == 'storyseeker') {
    mysqli_query($conn, "INSERT INTO storyseekers (username, email, password) VALUES ('$username', '$email', '$password')");
} else {
    mysqli_query($conn, "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')");
}
// redirect to the login page
header("Location: login.php");
exit;
// Close the database connection
mysqli_close($conn);
?>

