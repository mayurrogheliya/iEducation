<?php
session_start();
if (!isset($_SESSION['uemail'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

include_once("./backend/database.php"); // Include database connection file

// Get user email from session
$uemail = $_SESSION['uemail'];

// Query to delete user account
$query = "DELETE FROM register WHERE u_email = '$uemail'";
$result = mysqli_query($con, $query);

if ($result) {
    // Account deleted successfully
    unset($_SESSION['uemail']);
    echo "Your account has been deleted successfully.";
    header("Location: register.php");
} else {
    // Error deleting account
    echo "Error deleting account: " . mysqli_error($con);
    header("Location: profile.php");
}

// Close database connection
mysqli_close($con);
