<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>

    
    <title>MyTourista - #1 Stories Place for Tourist</title>
    
</head>
<body>
    <section>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="/mytourista">MyTourista</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Storyseeker</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Storyteller</a>
                        </li>                       
                        <li class="nav-item">
                        <a class="nav-link" href="storylist.php">Explore Stories</a>
                        </li>
                    </ul>

                    <button class="btn btn-primary mx-2 btn-sm" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>
                    <a data-bs-toggle="modal" data-bs-target="#searchmodal">
                      <form class="d-flex space-between" role="search">
                        <i class="bi bi-search mx-auto bg-primary px-2 py-1 text-white rounded-1 align-self-center"></i>
                    </form> 
                    </a>         



                </div>
            </nav>
    </section>

    <section>
      <div class="modal" id="exampleModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fs-5">Register as a Storyseeker or Storyteller</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">           

        <div class="container">
                  
              <form method="post" action="register.php">
                  <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                  <?php endif; ?>
                  <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select class="form-select" id="role" name="role" required>
                          <option value="">Select a role</option>
                          <option value="storyseeker">Storyseeker</option>
                          <option value="storyteller">Storyteller</option>
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>



 <section>
      <div class="modal" id="searchmodal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fs-5">Use a Search Term, Location or Category</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">           

        <div class="container">
              <form method="get" action="search.php">
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="query" class="form-control" placeholder="Search...">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Food">Food</option>
                <option value="Nature">Nature</option>
                <option value="Adventure">Adventure</option>
                <option value="Culture">Culture</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="location" class="form-control" placeholder="Location">
        </div>
        <div class="col-md-2">
            <button type="submit" name="search" class="btn btn-primary mb-3">Search</button>
        </div>
    </div>
</form>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</section>

<section>
   
</section>



   