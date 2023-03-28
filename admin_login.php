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
<?php include 'includes/admin_header.php';?>
    <div class="container-fluid bg-secondary py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 loginform text-white py-5 rounded-3">
            <h1 class="text-center mb-5">MyTourista Admin Login</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <p class="mt-3 mb-0 text-center">Don't have an account? <a href="admin_register.php" class="text-white fw-bold">Register</a></p>
        </div>
    </div>
</div>

    <!-- Bootstrap 5 JS -->
<?php include 'includes/footer.php';?>