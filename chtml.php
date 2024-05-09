<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chtml.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['uemail'])) {
        header("location: login.php");
        exit(); // Ensure script termination after redirection
    }

    include_once('./backend/database.php');

    // Fetch all ratings for the course
    $cname = $_GET['cname'];
    $get_ratings_query = "SELECT rating FROM reviews WHERE cname = '$cname'";
    $result_ratings = mysqli_query($con, $get_ratings_query);

    // Calculate average rating
    $total_ratings = 0;
    $num_ratings = mysqli_num_rows($result_ratings);
    while ($row = mysqli_fetch_assoc($result_ratings)) {
        $total_ratings += $row['rating'];
    }
    $average_rating = $num_ratings > 0 ? round($total_ratings / $num_ratings, 1) : 0;

    // Check if the user's email is present in the review database
    $userEmail = $_SESSION['uemail'];
    $cname = $_GET['cname'];
    $check_review_query = "SELECT * FROM reviews WHERE cname = '$cname' AND email = '$userEmail'";

    $select_user_query = "SELECT u_name FROM register WHERE u_email = '$userEmail'";
    $result = mysqli_query($con, $select_user_query);
    $row = mysqli_fetch_assoc($result);
    $userName = $row['u_name'];

    $result_check_review = mysqli_query($con, $check_review_query);
    if (mysqli_num_rows($result_check_review) > 0) {
        $review_disabled = true;
    }

    if (isset($_POST['btn'])) {
        // Get form data
        $userRating = $_POST['userRating'];
        $userReview = $_POST['userReview'];

        // Check if form fields are empty

        // Insert review into the database
        $insert_query = "INSERT INTO reviews (cname, rating, review,email,user_name) VALUES ('$cname', '$userRating', '$userReview','$userEmail','$userName')";
        if (mysqli_query($con, $insert_query)) {
            echo '
            <script> 
                alert("Review submitted successfully!");
                window.location.href = "course.php";
            </script>';
            exit();
        } else {
            echo '<script> alert("Error: Unable to submit review.") </script>';
        }
    }
    ?>
    <?php
    include_once("header.php");

    $cname = $_GET['cname'] ?? '';
    $q1 = "SELECT * FROM course where c_name = ?";
    $stmt1 = mysqli_prepare($con, $q1);
    mysqli_stmt_bind_param($stmt1, "s", $cname);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $t1row = mysqli_fetch_assoc($result1);

    $q2 = "SELECT * FROM topic where cname = ?";
    $stmt2 = mysqli_prepare($con, $q2);
    mysqli_stmt_bind_param($stmt2, "s", $cname);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $t2row = mysqli_fetch_assoc($result2);

    $reviews_query = "SELECT * FROM reviews WHERE cname = ?";
    $stmt3 = mysqli_prepare($con, $reviews_query);
    mysqli_stmt_bind_param($stmt3, "s", $cname);
    mysqli_stmt_execute($stmt3);
    $reviews_result = mysqli_stmt_get_result($stmt3);
    ?>

    <section class="py-5 py-xl-8" id="course">
        <div class="container">
            <div class="course-list">
                <h2>What do you learn in this <?php echo $t1row['c_name']; ?> course?</h2>
                <ul class="list-group">
                    <li class="list-group-item"><?php echo $t2row['point1']; ?></li>
                    <li class="list-group-item"><?php echo $t2row['point2']; ?></li>
                    <li class="list-group-item"><?php echo $t2row['point3']; ?></li>
                    <li class="list-group-item"><?php echo $t2row['point4']; ?></li>
                    <li class="list-group-item"><?php echo $t2row['point5']; ?></li>
                </ul>
            </div>
            <main class="mt-4">
                <a type="button" href="htmlchapter.php?cname=<?php echo $t1row['c_name']; ?>" class="btn btn-primary my-1 ">Go to Course
                    free</a>
                <a type="button" href="payment.php?cname=<?php echo $t1row['c_name']; ?>&uemail=<?php echo $_SESSION['uemail']; ?>" class="btn btn-primary my-1 ">Payment</a>
            </main>
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mt-3">User Reviews and Ratings</h2>
                <p class="mx-5 mt-3" style="font-style: italic; font-weight: bold;">Average Rating: <?php echo $average_rating; ?></p>
            </div>

            <div>
                <ul class="list-group reviews">
                    <?php
                    if ($reviews_result) {
                        if (mysqli_num_rows($reviews_result) > 0) {
                            while ($row = mysqli_fetch_assoc($reviews_result)) {
                                echo '<li class="list-group-item">';
                                echo '<div class="row">';
                                echo '<div class="col-md-6">' . htmlspecialchars($row['user_name']) . '</div>';
                                echo '<div class="col-md-6">Rating: ' . htmlspecialchars($row['rating']) . '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                echo '<div class="col-md-12">"' . htmlspecialchars($row['review']) . '"</div>';
                                echo '</div>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No reviews found.</li>';
                        }
                    } else {
                        echo '<li class="list-group-item">Error fetching reviews.</li>';
                    }
                    ?>
                </ul>
            </div>
            <?php

            ?>
            <div class="mt-4">
                <h2>Leave a Review</h2>
                <?php if (isset($review_disabled) && $review_disabled) { ?>
                    <p>You have already submitted a review for this course.</p>
                <?php } else { ?>
                    <form id="reviewForm" method="post" onsubmit="check()">
                        <div class="form-group mb-2 ">
                            <label for="userRating">Rating:</label>
                            <select class="form-control" id="userRating" name="userRating">
                                <option value="5">5 stars</option>
                                <option value="4">4 stars</option>
                                <option value="3">3 stars</option>
                                <option value="2">2 stars</option>
                                <option value="1">1 star</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 ">
                            <label for="userReview">Your Review:</label>
                            <textarea class="form-control" id="userReview" name="userReview" rows="3" placeholder="Enter your review" required></textarea>
                        </div>
                        <div>
                            <p id="err" style="color: red;"></p>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Submit</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
    include_once("footer.php");
    ?>

</body>

</html>