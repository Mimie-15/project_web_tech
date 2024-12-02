<?php
if (isset($_POST['delete'])) {
    # Include the database connection file
    include 'db.php';

    # Get the image name from the form input
    $img_name = $_POST['img_name'];

    # Prepare the SQL statement to delete the image record from the database
    $sql = "DELETE FROM images WHERE img_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$img_name]);

    # Define the path to the image file
    $img_path = 'uploads/' . $img_name;

    # Delete the image file from the server
    if (file_exists($img_path)) {
        unlink($img_path); // Remove the file
    }

    # Redirect to the index page after deletion
    header("Location: index.php");
    exit; // Ensure no further code is executed after redirection
}
?>
