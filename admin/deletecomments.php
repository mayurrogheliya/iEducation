<?php
// Include database connection
include_once("../backend/database.php");

// Check if a user's email is provided in the URL
if (isset($_GET['email'])) {
    // Sanitize the email to prevent SQL injection
    $email = $_GET['email'];

    // Construct the SQL query to delete the user
    $query = "DELETE FROM messages WHERE u_email = '$email'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Redirect to the user information page after successful deletion
        echo "<script>alert('Comment deleted successfully');</script>";
        echo "<script>window.location.href = 'comments.php';</script>";
        exit();
    } else {
        // Error handling if the deletion fails
        echo "Error: Unable to delete the comment.";
    }
} else {
    // Error handling if the email parameter is not provided in the URL
    echo "Error: Email parameter is missing.";
}
