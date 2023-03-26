<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit;
}


// Include database configuration
require_once 'config.php';


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


/// check if user is logged in

  // get user type


if (isset($_SESSION['user_id'])) {
  
  $user_id = $_SESSION['user_id'];
  $query_storyteller = "SELECT * FROM storytellers WHERE user_id = '$user_id'";
  $query_storyseeker = "SELECT * FROM storyseekers WHERE user_id = '$user_id'";
  $result_storyteller = mysqli_query($conn, $query_storyteller);
  $result_storyseeker = mysqli_query($conn, $query_storyseeker);
  $row = mysqli_fetch_assoc($result_storyteller);
  $username = $row['username'];

  
  if(mysqli_num_rows($result_storyteller) > 0 ) { // if user is a storyteller
   
    echo "Logged in as storyteller: " . $username;
  } elseif(mysqli_num_rows($result_storyseeker) > 0) { // if user is a storyseeker
    $row = mysqli_fetch_assoc($result_storyseeker);
    $username = $row['username'];
    echo "Logged in as storyseeker: " . $username;
  } else { // invalid user
    echo "Invalid user.";
  }

} else {
  echo "You are not logged in.";
  
}



mysqli_close($conn); // close database connection



?>



<?php include 'includes/usernav.php';?>



<div class="container my-5">
  <div class="row">
    <div class="col vh-100">
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
          <label for="author" class="form-label">Author:</label>
          <input type="text" id="author" name="author" class="form-control"><br>
        </div>
        <input type="submit" name="submit" value="Create Story" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success-modal">
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
    <div class="col vh-100">
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
                <?php foreach (explode(',', $story['images']) as $image): ?>
                  <img src="<?php echo $image; ?>" alt="Image" width="100">
                <?php endforeach; ?>
              </td>
              <td>
                <a href="edit_story.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="add_images.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Add Images</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      



<script>
  $(document).ready(function() {
    $("#new-story-form").submit(function(event) {
      event.preventDefault();
      var form = $(this);
      var formData = new FormData(form[0]);
      var thumbnailSelected = false; // variable to keep track of whether a thumbnail has been selected
      formData.getAll('thumbnail[]').forEach(function(file) {
        if (!thumbnailSelected && file.type.startsWith('image/')) {
          thumbnailSelected = true;
          formData.set('thumbnail', file); // set the first image file as the thumbnail
        } else {
          formData.append('images[]', file); // append additional image files to the images array
        }
      });
      if (!thumbnailSelected) { // check if a thumbnail has been selected
        alert("Please select a thumbnail image.");
        return;
      }
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Show success modal
          $('#success-modal').modal('show');
          // Reset form                    
            form[0].reset();
            $('#thumbnail-preview').empty(); // remove any previously displayed thumbnail previews
            $('#success-modal').modal('show');
            },
            error: function() {
            alert("An error occurred. Please try again later.");
            }
            });
            });
            });

            // Display thumbnail preview on file selection
            $(document).on('change', '#thumbnail', function() {
            $('#thumbnail-preview').empty();
            var files = $('#thumbnail')[0].files;
            if (files.length > 0) {
            // Only display the first thumbnail as selected thumbnail
            var thumbnail = files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
            $('#thumbnail-preview').append('<img class="img-thumbnail" src="' + event.target.result + '">');
            };
            reader.readAsDataURL(thumbnail);
            }
            });

            </script>
              




<?php include 'includes/footer.php';?>
