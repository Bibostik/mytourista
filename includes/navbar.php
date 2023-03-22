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
                        <a class="nav-link" href="storylist.php">Storylist</a>
                        </li>
                    </ul>

                    <button class="btn btn-primary mx-2 btn-sm" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Get started</button>
                    <form class="d-flex space-between" role="search">
                        <i class="bi bi-search mx-auto bg-primary px-2 py-1 text-white rounded-1 align-self-center"></i>
                    </form>          



                </div>
            </nav>
    </section>

    <section>
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="post" action="registerserver.php" class="my-3">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" id="username" required>
                <br>
                 <label for="username">Email:</label>
                <input class="form-control" type="email" name="email" id="email" required>
                <br>
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
                <br>
                
                  <label for="role">I am a:</label>
                <input class="form-check-input" type="radio" id="storyseeker" name="role" value="storyseeker" required>
                <label for="storyseeker">Story Seeker</label>
                <input class="form-check-input" type="radio" id="storyteller" name="role" value="storyteller" required>
                <label for="storyteller">Storyteller</label>
                <input type="submit" value="Register" class="btn btn-secondary">              
            </form>
            <span>Registered user <a href="login.php" class="link-danger text-decoration-none my-4">Login here</a></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>



   