<?php
// Database connection information
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";

// Connect to the database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $thumbnail = $_FILES['thumbnail']['name'];
    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];

    // Check if a new thumbnail was uploaded
    if ($thumbnail) {
        // Delete the old thumbnail file
        $sql = "SELECT thumbnail FROM stories WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $old_thumbnail = $row['thumbnail'];
        unlink("thumbnails/$old_thumbnail");

        // Upload the new thumbnail file
        $thumbnail_ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
        $new_thumbnail_name = "thumbnail_$id.$thumbnail_ext";
        move_uploaded_file($thumbnail_tmp, "thumbnails/$new_thumbnail_name");

        // Update the story with the new thumbnail file name and path
        $thumbnail_path = "thumbnails/" . $new_thumbnail_name;
        $sql = "UPDATE stories SET title = '$title', author = '$author', description = '$description', thumbnail = '$thumbnail_path' WHERE id = '$id'";
    } else {
        // Update the story without changing the thumbnail
        $sql = "UPDATE stories SET title = '$title', author = '$author', description = '$description' WHERE id = '$id'";
    }

    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
}

// Retrieve the story to be edited
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM stories WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>




<!DOCTYPE html>
<html>
<head>
    <title>Edit Story</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-3">Edit Story</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail:</label>
                <img src="thumbnails/<?php echo $row['thumbnail']; ?>" class="img-thumbnail mb-3">
                <img src="thumbnails/<?php echo $row['thumbnail']; ?>?t=<?php echo time(); ?>" alt="Thumbnail">
                <img src="thumbnails/<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['title']; ?>" class="img-thumbnail mb-3">


                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
