<!DOCTYPE html>
<html lang="en">
<!-- Retrieve a list of stories from Database  -->
<?php
// connect to the database
require_once 'config.php';

// query the database for the latest stories
$query = "SELECT * FROM stories ORDER BY id DESC LIMIT 8";
$result = mysqli_query($conn, $query);

// store the stories in an array
$stories = array();
while ($row = mysqli_fetch_assoc($result)) {
    // get an excerpt of about 20 words from the story content
    $content = strip_tags($row['description']);
    $excerpt = implode(' ', array_slice(explode(' ', $content), 0, 20));

    // add the story data to the array
    $row['excerpt'] = $excerpt;
    $stories[] = $row;
}
?>

<?php include 'includes/navbar.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/content.php';?>
<?php include 'includes/footer.php';?>



    


    




    
