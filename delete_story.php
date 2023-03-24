<?php
// Database connection information
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";

// Connect to the database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Delete the story with the specified ID
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM stories WHERE id = '$id'";
    mysqli_query($conn, $sql);
}

header("Location: admin.php");
?>
