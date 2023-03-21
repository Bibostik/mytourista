<?php
session_start();

// check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
    // redirect to home page
    header('location: index.php');
    exit;
}
?>

<!-- HTML code for the page goes here -->


<?php
// start the session
session_start();

// connect to the database
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

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
mysqli_query($conn, $query);

// redirect to the homepage
header("Location: index.php");
exit;
?>
