<?php
// Include database connection
include_once("../backend/database.php");

// Check if a course's id is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the id to prevent SQL injection
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch the course's image file path from the database
    $image_query = "SELECT c_image FROM course WHERE c_id = '$id'";
    $image_result = mysqli_query($con, $image_query);
    if ($image_row = mysqli_fetch_assoc($image_result)) {
        // Delete the image file from the directory
        $image_path = "../CourseImage/" . $image_row['c_image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }
    }

    // Construct the SQL query to delete the course
    $query = "DELETE FROM course WHERE c_id = '$id'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Redirect to the course information page after successful deletion
        header("Location: course.php");
        exit();
    } else {
        // Error handling if the deletion fails
        echo "Error: Unable to delete the course.";
    }
} else {
    // Error handling if the id parameter is not provided in the URL
    echo "Error: id parameter is missing.";
}
