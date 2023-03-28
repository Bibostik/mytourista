<?php
// connect to the database
require_once 'config.php';

// check if story ID was passed
if (!isset($_GET['id'])) {
  header('Location: dashboard.php');
  exit();
}

$id = $_GET['id'];

// check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get form data
  $title = $_POST['title'];
  $category = $_POST['category'];
  $location = $_POST['location'];
  $description = $_POST['description'];

  // update story in database
  $update_query = "UPDATE stories SET title = '$title', category = '$category', location = '$location', description = '$description' WHERE id = $id";
  mysqli_query($conn, $update_query);

  // redirect to dashboard
  header('Location: dashboard.php');
  exit();
}

// get story from database
$story_query = "SELECT * FROM stories WHERE id = $id";
$result = mysqli_query($conn, $story_query);
$story = mysqli_fetch_assoc($result);
?>

<div class="container my-5">
  <div class="row">
    <div class="col">
      <h2>Edit Story</h2>
      <form method="POST">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="<?php echo $story['title']; ?>" required>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" id="category" name="category" value="<?php echo $story['category']; ?>" required>
        </div>
        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" class="form-control" id="location" name="location" value="<?php echo $story['location']; ?>" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $story['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>
</div>
