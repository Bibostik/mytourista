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

<?php

// connect to the database
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// query the database for all stories

$query = "SELECT id, title, author, thumbnail, description FROM stories";
$result = mysqli_query($conn, $query);

// store the stories in an array
$stories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stories[] = $row;
}
?>


<div class="container">
        <h1>All Stories</h1>
        <div class="row">
            <?php foreach ($stories as $story): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($story['thumbnail']): ?>
                            <img class="card-img-top" src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $story['title']; ?></h5>
                            <p class="card-text"><?php echo $story['author']; ?></p>
                            <a href="singlestory.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>