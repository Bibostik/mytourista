<?php
// Database connection information
require_once 'config.php';

// Delete the story with the specified ID
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM stories WHERE id = '$id'";
    mysqli_query($conn, $sql);
}

header("Location: admin.php");
?>
