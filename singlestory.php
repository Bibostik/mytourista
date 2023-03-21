<?php
// connect to the database
$db_host = "localhost";
$db_user = "mytouristaadmin";
$db_pass = "CONTROLLer1000";
$db_name = "my_touristadb";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// get the story ID from the query string
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$story_id = $_GET['id'];

// query the database for the story with the given ID
$query = "SELECT title, author, thumbnail, description FROM stories WHERE id = $story_id";
$result = mysqli_query($conn, $query);

// check if the story exists
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// get the story data
$story = mysqli_fetch_assoc($result);
?>

<?php include 'includes/usernav.php';?>


    <h1><?php echo $story['title']; ?></h1>
    <p>by <?php echo $story['author']; ?></p>
    <?php if ($story['thumbnail']): ?>
        <img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>">
    <?php endif; ?>
    <p><?php echo $story['description']; ?></p>

