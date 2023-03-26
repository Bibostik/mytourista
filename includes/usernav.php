
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/main.css">

   

<!-- Use the $story variable to set the page title -->

<title>User Area</title> 
    
</head>
<body>
<section>
 
<?php
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'storyseeker' || $_SESSION['user_type'] == 'storyteller')) {
    // User is logged in as either a storyseeker or storyteller
    // Get user information from the database
    include('config.php');
    $user_id = $_SESSION['user_id'];
    $query = "SELECT user_id, username FROM storytellers WHERE user_id = '$user_id' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        echo isset($user['username']) ? $user['username'] : '';
    }

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

}



?>

<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyTourista</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'storyseeker' || $_SESSION['user_type'] == 'storyteller')) { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Logged in as <?php $user = mysqli_fetch_assoc($result); var_dump($user); echo isset($user['username']) ? $user['username'] : ''; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</section>


    </section>




   