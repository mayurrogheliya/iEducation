<?php
// Include database connection
include_once("../backend/database.php");

// Check if a course's id is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the id to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Construct the SQL queries to delete related data
    $delete_query = "DELETE FROM reviews WHERE id = '$id'";

    // Execute the queries
    if (mysqli_query($con, $delete_query)) {
        // Redirect to the course information page after successful deletion
        header("Location: review.php");
        exit();
    } else {
        // Error handling if the deletion fails
        echo "Error: Unable to delete the review.";
    }
} else {
    // Error handling if the id parameter is not provided in the URL
    echo "Error: id parameter is missing.";
}
