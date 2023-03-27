<!DOCTYPE html>
<html>

<!-- login form -->
<?php include 'includes/navbar.php';?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 400px;">
    <div class="card-body">
      <h5 class="card-title mb-4">Login</h5>
      <form method="post" action="loginserver.php">
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
  
        <div class="mb-3">
          <label for="user_type" class="form-label">Login as:</label>
          <div class="form-check">
            <input type="radio" id="storyseeker" name="user_type" value="storyseeker" class="form-check-input" required>
            <label for="storyseeker" class="form-check-label">Storyseeker</label>
          </div>
          <div class="form-check">
            <input type="radio" id="storyteller" name="user_type" value="storyteller" class="form-check-input" required>
            <label for="storyteller" class="form-check-label">Storyteller</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <div class="mt-3 text-left">
          <p>Not registered yet? <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-primary pointer">Register here</a>.</p>
        </div>

        <?php if (!empty($error_msg)): ?>
          <p style="color:red;"><?php echo $error_msg; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>






<?php include 'includes/footer.php';?>










