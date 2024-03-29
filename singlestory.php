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



?>

<?php include 'includes/usernav.php';?>

<?php
// connect to the database
require_once 'config.php';

// get the story ID from the query string
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$story_id = $_GET['id'];

// query the database for the story with the given ID
$query = "SELECT title, author, thumbnail, description, images FROM stories WHERE id = $story_id";
$result = mysqli_query($conn, $query);

// check if the story exists
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// get the story data
$story = mysqli_fetch_assoc($result);
?>



<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1><?php echo $story['title']; ?></h1>
            <p>by <?php echo $story['author']; ?></p>
            <?php if ($story['thumbnail']): ?>
            <img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>" class="img-thumbnail">
            <?php endif; ?>
            <?php if ($story['images']): ?>
            <div class="row mt-4">
                <?php foreach (explode(',', $story['images']) as $image): ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="<?php echo $image; ?>" alt="<?php echo $story['title']; ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <p><?php echo $story['description']; ?></p>
        </div>
    </div>
</div>



    

   
<?php include 'includes/footer.php';?>