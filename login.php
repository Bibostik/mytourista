<!DOCTYPE html>


<!-- login form -->
<?php include 'includes/navbar.php';?>


<div class="container">
    <div class="row">
        <div class="col mx-auto d-grid vh-100">
           <form  method="post" action="loginserver.php">
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

             <?php if (!empty($error_msg)): ?>
        <p style="color:red;"><?php echo $error_msg; ?></p>
              <?php endif; ?>
          </form>
        </div>
    </div>
</div>
<!-- Login User -->





<?php include 'includes/footer.php';?>










