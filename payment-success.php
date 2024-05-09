<?php
// Assuming you have a database connection established
include_once("./backend/database.php");

// Check if the $_GET array is set and not empty
if (isset($_GET) && !empty($_GET)) {
    // Extract the values from the $_GET array
    $oid = $_GET['oid'];
    $rp_payment_id = $_GET['rp_payment_id'];
    $rp_signature = $_GET['rp_signature'];
    $email = $_GET['uemail'];
    $cname = $_GET['cname'];

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO payment (order_id,payment_id,email,cname) VALUES ('$oid', '$rp_payment_id','$email','$cname')";
    // If record inserted successfully in payment table
    // Now update the payment status in the register table
    $updateSql = "UPDATE register SET payment = 'Yes' WHERE u_email = '$email'";
    if (mysqli_query($con, $updateSql)) {
        // If payment status updated successfully in the register table
        header("Location: course.php");
        exit(); // Stop further execution after redirection
    } else {
        echo "Error updating payment status: " . mysqli_error($con);
    }
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}
