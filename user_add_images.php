<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit;
}

// connect to the database
require_once 'config.php';

$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];

if ($user_type === 'storyseeker') {
    $table_name = 'storyseekers';
} elseif ($user_type === 'storyteller') {
    $table_name = 'storytellers';
}
// Retrieve the user's information from the database
$query = "SELECT * FROM $table_name WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

}


// Retrieve the stories created by the user from the database
$sql = "SELECT * FROM stories WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
// Initialize an empty array to store the user's stories
$stories = array();

// Check if the query was successful and if there are results
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stories[] = $row;
    }
}


// check if the search form was submitted
if (isset($_GET['search'])) {
    $search_query = $_GET['query'];
    $category = $_GET['category'];
    $location = $_GET['location'];
    
    // construct the SQL query with the search criteria
    $query = "SELECT id, title, author, thumbnail, description, location, category FROM stories WHERE 
                (title LIKE '%$search_query%' OR description LIKE '%$search_query%') AND
                category = '$category' AND location = '$location'
              ORDER BY `id` DESC";
} else {
    // default query to get all stories
    $query = "SELECT id, title, author, thumbnail, description, location, category FROM stories ORDER BY `id` DESC";
}

// execute the query
$result = mysqli_query($conn, $query);

// store the stories in an array
$stories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stories[] = $row;
}
?>
<?php
// connect to the database
require_once 'config.php';

// initialize variables
$errors = array();
$story_id = '';
$existing_images = array();

// check if the story id was passed
if (isset($_GET['id'])) {
    $story_id = $_GET['id'];

    // get existing images
    $query = "SELECT images FROM stories WHERE id = $story_id";
    $result = mysqli_query($conn, $query);
    $story = mysqli_fetch_assoc($result);
    $existing_images = explode(',', $story['images']);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'includes/usernav.php';?>
<!-- display the form -->


<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2>Edit Images</h2>
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
        <div class="form-group">
          <label for="existing-images">Existing Images</label>
          <?php if (!empty($existing_images)): ?>
          <div class="row">
            <?php foreach ($existing_images as $image): ?>
            <div class="col-md-4">
              <div class="card mb-4">
                <img src="<?php echo $image; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <a href="user_delete_image.php?id=<?php echo $story_id; ?>&image=<?php echo $image; ?>"
                    class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
          <p>No existing images found.</p>
          <?php endif; ?>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
