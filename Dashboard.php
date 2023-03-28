




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

// Close the connection
mysqli_close($conn);

?>



<!DOCTYPE html>

<?php include 'includes/usernav.php';?>
<div class="container my-5">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <form id="new-story-form" method="post" action="create_story.php" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="title" class="form-label">Title:</label>
          <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="thumbnail" class="form-label">Thumbnail:</label>
          <input type="file" name="thumbnail[]" id="thumbnail" class="form-control" multiple required>
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Images:</label>
          <input type="file" name="images[]" id="images" class="form-control" multiple required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label for="location" class="form-label">Location:</label>
          <input type="text" name="location" id="location" class="form-control">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category:</label>
          <select name="category" id="category" class="form-control">
            <option value="">Select Category</option>
            <option value="travel">Nature</option>
            <option value="food">Food</option>
            <option value="lifestyle">Adventure</option>
            <option value="technology">Technology</option>
            <option value="technology">Culture</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="author" class="form-label">Author:</label>
          <input type="text" name="author" id="author" class="form-control">
        </div>
        <div class="d-grid gap-2">
          <button type="submit" name="submit" class="btn btn-primary">Create Story</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" aria-labelledby="success-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="success-modal-label">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Your story has been successfully submitted.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="container my-5">
  <div class="row">
    <div class="col">
      <h2>Your Stories</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Thumbnail</th>
            <th>Images</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stories as $story): ?>
            <tr>
              <td><?php echo $story['title']; ?></td>
              <td><?php echo $story['description']; ?></td>
              <td><img src="<?php echo $story['thumbnail']; ?>" alt="Thumbnail" width="100"></td>
              <td>
                <?php if (isset($story['images'])): ?>
                  <?php foreach (explode(',', $story['images']) as $image): ?>
                    <img src="<?php echo $image; ?>" alt="Image" width="100">
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td>
                <a href="user_edit_story.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="user_add_images.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Add Images</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'includes/footer.php';?>
