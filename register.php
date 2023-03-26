<?php
// // Get the form data
// $username = $_POST['username'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $role = $_POST['role'];

// // Connect to the database
// require_once 'config.php';

// // Check if the username or email already exists
// $user_check_query = "SELECT * FROM storyseekers WHERE username='$username' OR email='$email' UNION SELECT * FROM storytellers WHERE username='$username' OR email='$email' LIMIT 1";
// $result = mysqli_query($conn, $user_check_query);
// $user = mysqli_fetch_assoc($result);

// if ($user) {
//     if ($user['username'] === $username) {
//         // Username already exists
//         $error = "Username already exists";
//     }

//     if ($user['email'] === $email) {
//         // Email already exists
//         $error = "Email already exists";
//     }
// }

// // Insert the user data into the appropriate table
// if ($role == 'storyseeker') {
//     mysqli_query($conn, "INSERT INTO storyseekers (username, email, password) VALUES ('$username', '$email', '$password')");
// } else {
//     mysqli_query($conn, "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')");
// }
// // redirect to the login page
// header("Location: login.php");
// exit;
// // Close the database connection
// mysqli_close($conn);
?>




<?php



// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Connect to the database
require_once 'config.php';
$email = $_POST['email'];
$query = "SELECT COUNT(*) FROM storytellers WHERE email = '$email'";
$result = mysqli_query($conn, $query);
if (mysqli_fetch_row($result)[0] > 0) {
    // Email already exists, display an error message and redirect back to index.php
    echo '<div class="alert alert-danger" role="alert">Email address already exists. Please choose a different email or <a href="login.php">log in</a> instead.</div>';
    header("Refresh:10; url=index.php");
    exit();
} else {
    // Email is unique, insert the new record
    $query = "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);
    // Display a success message or redirect to a success page
    header("Location: login.php");
    exit;
}

// Check if the username or email already exists
$user_check_query = "SELECT * FROM storyseekers WHERE username='$username' OR email='$email' UNION SELECT * FROM storytellers WHERE username='$username' OR email='$email' LIMIT 1";
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
}
else {
    // Insert the user data into the appropriate table if there are no errors
    if ($role == 'storyseeker') {
        mysqli_query($conn, "INSERT INTO storyseekers (username, email, password) VALUES ('$username', '$email', '$password')");
    } else {
        mysqli_query($conn, "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')");
    }

    // redirect to the login page
    header("Location: login.php");
    exit;
}

// Close the database connection
mysqli_close($conn);

?>

