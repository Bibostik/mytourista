<!DOCTYPE html>

<?php include 'includes/admin_header.php'; ?>

<?php
session_start();

// Check if user is not logged in as admin
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit;
}


// Database connection information
require_once 'config.php';

// Retrieve all stories with corresponding storyteller and storyseeker usernames
$sql = "SELECT stories.id, stories.title, stories.author, stories.description, stories.thumbnail, stories.username AS story_username, 
        storytellers.username AS storyteller_username, storyseekers.username AS storyseeker_username
        FROM stories
        LEFT JOIN storytellers ON stories.id = storytellers.user_id
        LEFT JOIN storyseekers ON stories.id = storyseekers.user_id";

$result = mysqli_query($conn, $sql);

?>


    <div class="container my-4">
        <h1>Admin Panel</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Story ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Story Username</th>
                    <th>Storyteller Username</th>
                    <th>Storyseeker Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><img src="<?php echo $row['thumbnail']; ?>" height="50"></td>
                        <td><?php echo $row['story_username']; ?></td>
                        <td><?php echo $row['storyteller_username']; ?></td>
                        <td><?php echo $row['storyseeker_username']; ?></td>
                        <td >
                            <span class="d-grid gap-2 mx-auto">
                                <a href="edit_story.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm ">Edit</a>
                            <a href="delete_story.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Are you sure you want to delete this story?')">Delete</a>
                            </span>
                            

 
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


<?php include 'includes/admin_footer.php';?>



