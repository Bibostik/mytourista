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

// Check if the username or email already exists
$user_check_query = "SELECT * FROM storyseekers WHERE username='$username' OR email='$email' UNION SELECT * FROM storytellers WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) {
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

