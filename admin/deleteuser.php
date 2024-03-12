<?php
// Include database connection
include_once("../backend/database.php");

// Check if a user's email is provided in the URL
if (isset($_GET['email'])) {
    // Sanitize the email to prevent SQL injection
    $email = mysqli_real_escape_string($con, $_GET['email']);

    // Fetch the user's image file path from the database
    $image_query = "SELECT u_photo FROM register WHERE u_email = '$email'";
    $image_result = mysqli_query($con, $image_query);
    if ($image_row = mysqli_fetch_assoc($image_result)) {
        // Delete the image file from the directory
        $image_path = "../uploads/" . $image_row['u_photo'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }
    }

    // Construct the SQL query to delete the user
    $query = "DELETE FROM register WHERE u_email = '$email'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Redirect to the user information page after successful deletion
        header("Location: user.php");
        exit();
    } else {
        // Error handling if the deletion fails
        echo "Error: Unable to delete the user.";
    }
} else {
    // Error handling if the email parameter is not provided in the URL
    echo "Error: Email parameter is missing.";
}
