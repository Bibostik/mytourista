<?php
// connect to the database
require_once 'config.php';

// initialize variables
$query = "";
$category = "";
$location = "";

// check if search parameters were passed
if (isset($_GET['search'])) {
    // get search query
    $query = $_GET['query'];

    // get category parameter
    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $category = $_GET['category'];
        $category_query = " AND category LIKE '%$category%'";
    } else {
        $category_query = "";
    }

    // get location parameter
    if (isset($_GET['location']) && $_GET['location'] !== '') {
        $location = $_GET['location'];
        $location_query = " AND location LIKE '%$location%'";
    } else {
        $location_query = "";
    }

    // query the database
    $search_query = "SELECT id, title, author, thumbnail, description FROM stories WHERE (title LIKE '%$query%' OR description LIKE '%$query%' OR author LIKE '%$query%' OR location LIKE '%$query%' OR category LIKE '%$query%')$category_query$location_query ORDER BY id DESC";
    $result = mysqli_query($conn, $search_query);

    // store the stories in an array
    $stories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $stories[] = $row;
    }
}
?>


<!-- display the search results -->
<div class="container">
    <h2>Search Results</h2>
    <!-- <?php if (count($stories)): ?>
        <?php foreach ($stories as $story): ?>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>" class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h3><?php echo $story['title']; ?></h3>
                    <p><strong>Author:</strong> <?php echo $story['author']; ?></p>
                    <p><?php echo $story['description']; ?></p>
                    <a href="story.php?id=<?php echo $story['id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No stories found.</p>
    <?php endif; ?> -->




    <?php if (isset($_GET['search']) && count($stories) > 0): ?>
        <h3>Search Results:</h3>
        <?php foreach ($stories as $story): ?>
            <div>
                <h4><a href="story.php?id=<?php echo $story['id']; ?>"><?php echo $story['title']; ?></a></h4>
                <p>Author: <?php echo $story['author']; ?></p>
                <p><?php echo $story['description']; ?></p>
                <img src="<?php echo $story['thumbnail']; ?>" alt="<?php echo $story['title']; ?>">
            </div>
        <?php endforeach; ?>
    <?php elseif (isset($_GET['search']) && count($stories) == 0): ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>
