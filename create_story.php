<?php

// connect to the database

require_once 'config.php';

// check if the database connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// get the story data from the form
$title = mysqli_real_escape_string($conn, $_POST['title']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$username = $_SESSION['username'];
$description = mysqli_real_escape_string($conn, $_POST['description']);

// move the thumbnail file to a directory on the server
$thumbnail_name = $_FILES['thumbnail']['name'];
$thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
$thumbnail_extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
$thumbnail_new_name = uniqid() . "." . $thumbnail_extension;
$thumbnail_destination = "thumbnails/" . $thumbnail_new_name;
move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination);

// insert the story data into the database
$query = "INSERT INTO stories (title, author, username, thumbnail, description) VALUES ('$title', '$author', '$username', '$thumbnail_destination', '$description')";
$result = mysqli_query($conn, $query);

if ($result) {
    // display pop-up alert and redirect to dashboard
    echo "<script>alert('Submission successful!'); window.location.href='dashboard.php';</script>";
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
