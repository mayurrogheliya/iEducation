<?php
include_once("../backend/database.php");

if (isset($_GET['cname'])) {
    $cname = mysqli_real_escape_string($con, $_GET['cname']);
    $delete_query1 = "DELETE FROM quizstart WHERE cname = '$cname'";
    $delete_query2 = "DELETE FROM quiz WHERE cname = '$cname'";

    if (mysqli_query($con, $delete_query1) && mysqli_query($con, $delete_query2)) {
        header("Location: adminQuiz.php");
        exit();
    } else {
        echo "Error: Unable to delete the quiz.";
    }
} else {
    echo "Error: id parameter is missing.";
}
