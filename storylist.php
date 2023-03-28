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


// check if the search form was submitted
if (isset($_GET['search'])) {
    $search_query = $_GET['query'];
    $category = $_GET['category'];
    $location = $_GET['location'];
    
    // construct the SQL query with the search criteria
    $query = "SELECT id, title, author, thumbnail, description, location, category FROM stories WHERE 
                (title LIKE '%$search_query%' OR description LIKE '%$search_query%') AND
                category = '$category' AND location = '$location'
              ORDER BY `id` DESC";
} else {
    // default query to get all stories
    $query = "SELECT id, title, author, thumbnail, description, location, category FROM stories ORDER BY `id` DESC";
}

// execute the query
$result = mysqli_query($conn, $query);

// store the stories in an array
$stories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stories[] = $row;
}
?>


<!DOCTYPE html>
<?php include 'includes/usernav.php';?>

<div class="container">
    <h1>All Stories</h1>
    
    <!-- search form -->
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
                            <p class="card-text"><?php echo $story['location']; ?></p>
                            <p class="card-text"><?php echo $story['category']; ?></p>
                            <a href="singlestory.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<?php include 'includes/footer.php';?>

        
