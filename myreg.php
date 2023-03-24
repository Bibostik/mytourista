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
    if ($user['username'] === $username) {
        // Username already exists
        $error = "Username already exists";
    }

    if ($user['email'] === $email) {
        // Email already exists
        $error = "Email already exists";
    }
}

if (!empty($username)) {
    if ($role == 'storyseeker') {
        mysqli_query($conn, "INSERT INTO storyseekers (username, email, password) VALUES ('$username', '$email', '$password')");
    } else {
        mysqli_query($conn, "INSERT INTO storytellers (username, email, password) VALUES ('$username', '$email', '$password')");
    }

    // redirect to the login page
    header("Location: login.php");
    exit;
} else {
    $error = "Username cannot be empty";
}


// Insert the user data into the appropriate table if there are no errors
if (!isset($error)) {
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

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="register.php">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <label>Role:</label>
        <select name="role" required>
            <option value="">--Select Role--</option>
            <option value="storyseeker">Storyseeker</option>
            <option value="storyteller">Storyteller</option>
        </select>
        <br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
