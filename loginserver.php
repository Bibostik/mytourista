<?php
// Start the session
session_start();

// Connect to the database
require_once 'config.php';

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

// Authenticate the user
if ($user_type == 'storyseeker') {
    $table = 'storyseekers';
} else {
    $table = 'storytellers';
}

$query = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if the user is authenticated
if ($user) {
    // Set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['user_id'];
    $_SESSION['user_type'] = $user_type;
    
    // Redirect the user to the appropriate page
    if ($user_type == 'storyseeker') {
        header("Location: storylist.php");
    } else {
        header("Location: dashboard.php");
    }
} else {
    // If authentication fails, show an error message
    echo "<script>alert('Invalid Login Credentials!'); window.location.href='dashboard.php';</script>";
}

// Close the database connection
mysqli_close($conn);
?>
