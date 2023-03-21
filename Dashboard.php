<?php include 'includes/navbar.php';?>

<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']) !== true) {
    // redirect user to login page
    header("location: login.php");
    exit;
}
?>



<form id="new-story-form" method="post" action="create_story.php" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="thumbnail">Thumbnail:</label>
    <input type="file" name="thumbnail" id="thumbnail" required>
    <br>
    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>
    <br>
     <label for="author">Author:</label>
    <input type="text" id="author" name="author"><br>
    <input type="submit" name="submit" value="Create Story">
</form>
    </div>
  </div>
</div>




<?php include 'includes/footer.php';?>
