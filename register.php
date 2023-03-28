<?php
// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Connect to the database
require_once 'config.php';

// Check if the username or email already exists in either table
$user_check_query = "SELECT * FROM storyseekers s JOIN storytellers t ON s.username = t.username OR s.email = t.email WHERE s.username='$username' OR s.email='$email' OR t.username='$username' OR t.email='$email' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);


if ($user) {
    if ($user['username'] === $username) {
        // Username already exists
        $error = "Username already exists";
    }

    if ($user['email'] === $email) {
        // Email already exists
        $error = "Email already exists";
    }
} else {
    // Insert the user data into the appropriate table
    if ($role == 'storyseeker') {
        mysqli_query($conn, "INSERT INTO storyseekers (username, email, password) VALUES ('$username', '$email', '$password')");
    } else if ($role == 'storyteller') {
        mysqli_query($conn, "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')");
    } else {
        // Handle invalid role
        $error = "Invalid role";
    }

    // Redirect to the login page
    header("Location: login.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>


