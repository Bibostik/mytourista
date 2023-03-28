<?php
// connect to the database
require_once 'config.php';

// check if the image id and story id were passed
if (isset($_GET['id']) && isset($_GET['image_id'])) {
    $story_id = $_GET['id'];
    $image_id = $_GET['image_id'];

    // get the image path from the database
    $query = "SELECT images FROM stories WHERE id = $story_id";
    $result = mysqli_query($conn, $query);
    $story = mysqli_fetch_assoc($result);

    // remove the image path from the array
    $images = explode(',', $story['images']);
    unset($images[$image_id]);

    // update the database with the new image paths
    $image_paths = implode(',', $images);
    $update_query = "UPDATE stories SET images = '$image_paths' WHERE id = $story_id";
    mysqli_query($conn, $update_query);

    // delete the image file from the server
    $image_path = 'images/' . basename($images[$image_id]);
    unlink($image_path);

    // redirect to the story page
    header("Location: user_view_story.php?id=$story_id");
    exit();
} else {
    // if the image id and story id were not passed, redirect to the dashboard
    header("Location: dashboard.php");
    exit();
}
?>
