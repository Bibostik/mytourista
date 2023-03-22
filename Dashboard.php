<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit;
}
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
          <input type="file" name="thumbnail" id="thumbnail" class="form-control" required>
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

<script>
  $(document).ready(function() {
    $("#new-story-form").submit(function(event) {
      event.preventDefault();
      var form = $(this);
      var formData = new FormData(form[0]);
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
        },
        error: function() {
          alert("An error occurred. Please try again later.");
        }
      });
    });
  });
</script>   




<?php include 'includes/footer.php';?>
