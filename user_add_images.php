<?php
// connect to the database
require_once 'config.php';

// initialize variables
$errors = array();
$story_id = '';

// check if the story id was passed
if (isset($_GET['id'])) {
    $story_id = $_GET['id'];
}

// check if the form was submitted
if (isset($_POST['submit'])) {
    // get uploaded images
    $images = array();
    foreach ($_FILES['images']['name'] as $key => $value) {
        $image_name = $_FILES['images']['name'][$key];
        $image_tmp = $_FILES['images']['tmp_name'][$key];
        $image_size = $_FILES['images']['size'][$key];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $valid_extensions = array('jpg', 'jpeg', 'png');

        // check if the file is a valid image
        if (!in_array(strtolower($image_ext), $valid_extensions)) {
            $errors[] = 'Invalid file type: ' . $image_name;
        }

        // check if the file size is within the allowed limit (10MB)
        if ($image_size > 10000000) {
            $errors[] = 'File size exceeds limit: ' . $image_name;
        }

        // generate a unique filename
        $image_new_name = uniqid('', true) . '.' . $image_ext;

        // move the uploaded file to the images directory
        $image_destination = 'images/' . $image_new_name;
        move_uploaded_file($image_tmp, $image_destination);

        // add the image path to the array
        $images[] = $image_destination;
    }

    // insert the images into the database
    if (empty($errors)) {
        $image_paths = implode(',', $images);
        $insert_query = "UPDATE stories SET images = CONCAT(IFNULL(images, ''), '$image_paths') WHERE id = $story_id";
        mysqli_query($conn, $insert_query);
        header('Location: dashboard.php');
        exit();
    }
}
?>

<!-- display the form -->
<div class="container my-5">
    <div class="row">
        <div class="col">
            <h2>Add Images</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="images">Upload Images</label>
                    <input type="file" name="images[]" class="form-control-file" multiple>
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
