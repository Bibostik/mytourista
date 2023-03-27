<?php
// connect to the database
require_once 'config.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into database
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        // Send email alert
        $to = "pointxtech@gmail.com";
        $subject = "New message received from MyTourista contact form";
        $body = "Hello,\n\nA new message has been received from the MyTourista contact form:\n\nName: $name\nEmail: $email\nMessage: $message";
        $headers = "From: noreply@mytourista.com";

        ini_set("SMTP", "mail.google.com");
        ini_set("smtp_port", "25");

        mail($to, $subject, $body, $headers);

        echo "<script>alert('Your message has been sent. Thank you!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Close database connection
mysqli_close($conn);
?>
