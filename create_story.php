<?php
session_start();

// connect to the database
require_once 'config.php';

// check if the database connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// get the story data from the form
$title = mysqli_real_escape_string($conn, $_POST['title']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

$description = mysqli_real_escape_string($conn, $_POST['description']);

// move the thumbnail file to a directory on the server
$thumbnail_names = $_FILES['thumbnail']['name'];
$thumbnail_tmp_names = $_FILES['thumbnail']['tmp_name'];
$thumbnail_extensions = array();
$thumbnail_new_names = array();
$thumbnail_destinations = array();

// loop through each uploaded thumbnail file
foreach ($thumbnail_names as $key => $thumbnail_name) {
    $thumbnail_tmp_name = $thumbnail_tmp_names[$key];
    $thumbnail_extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
    $thumbnail_new_name = uniqid() . "." . $thumbnail_extension;
    $thumbnail_destination = "thumbnails/" . $thumbnail_new_name;
    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination);
    // add the thumbnail file details to their respective arrays
    array_push($thumbnail_extensions, $thumbnail_extension);
    array_push($thumbnail_new_names, $thumbnail_new_name);
    array_push($thumbnail_destinations, $thumbnail_destination);
}

// check if a thumbnail file was selected
if (empty($_POST['selected_thumbnail'])) {
    $selected_thumbnail = $thumbnail_destinations[0]; // default to the first uploaded thumbnail
} else {
    $selected_thumbnail = mysqli_real_escape_string($conn, $_POST['selected_thumbnail']);
}

// insert the story data into the database
$query = "INSERT INTO stories (title, author, username, thumbnail, thumbnail_extension, thumbnail_new_name, description) VALUES ('$title', '$author', '$username', '$selected_thumbnail', '{$thumbnail_extensions[array_search(pathinfo($selected_thumbnail, PATHINFO_EXTENSION), $thumbnail_extensions)]}', '{$thumbnail_new_names[array_search(pathinfo($selected_thumbnail, PATHINFO_EXTENSION), $thumbnail_extensions)]}', '$description')";
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