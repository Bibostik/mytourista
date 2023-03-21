<?php
// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Connect to the database
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

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

