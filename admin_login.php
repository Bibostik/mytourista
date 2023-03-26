<?php

// Start session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
require_once 'config.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    

    // Check if the username and password are valid
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Login successful, store admin username in session
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        // Login failed, display error message
        $error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container w-40 me-auto bg-secondary text-white py-5 loginform">
        <h1 class="text-center mx-5">MyTourista Admin Login</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="post" class="w-50 mx-auto " >
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3 w-50 mx-auto">Don't have an account? <a href="admin_register.php">Register</a></p>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-TJ6XsMZ8pFfC1vPSlRcxtSRlKo8aCN0m+05kAJ0r3qav9Y8WJiQ7vswf4n3qnh3J8k/YeUMtFWTCZSx5d5Vizw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
