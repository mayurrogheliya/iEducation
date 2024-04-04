<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chtml.css">
</head>

<body>
    <?php
    include_once("header.php");
    include_once("./backend/database.php");
    $cname = $_GET['cname'] ?? '';

    $q1 = "SELECT * FROM course where c_name = '$cname'";
    $q2 = "SELECT * FROM topic where cname = '$cname'";
    $result1 = mysqli_query($con, $q1);
    $result2 = mysqli_query($con, $q2);
    $t1row = mysqli_fetch_assoc($result1);
    $t2row = mysqli_fetch_assoc($result2);
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
                <a type="button" href="htmlchapter.php" class="btn btn-primary my-1 ">Go to Course
                    free</a>
                <a type="button" href="payment.php" class="btn btn-primary my-1 ">Get Certificate</a>
            </main>
            <h2 class="mt-3 ">User Reviews and Ratings</h2>
            <div>
                <ul class="list-group reviews">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">User 1</div>
                            <div class="col-md-6">Rating: 4</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">"Great course! Highly recommended."</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">User 2</div>
                            <div class="col-md-6">Rating: 5</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">"Amazing content and easy to follow."</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mt-4">
                <h2>Leave a Review</h2>
                <form id="reviewForm">
                    <div class="form-group mb-2 ">
                        <label for="userName">Your Name:</label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group mb-2 ">
                        <label for="userRating">Rating:</label>
                        <select class="form-control" id="userRating" required>
                            <option value="5">5 stars</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 star</option>
                        </select>
                    </div>
                    <div class="form-group mb-2 ">
                        <label for="userReview">Your Review:</label>
                        <textarea class="form-control" id="userReview" rows="3" placeholder="Enter your review" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </section>



    <script>
        document.getElementById("reviewForm").addEventListener("submit", function(event) {
            event.preventDefault();

            // Get values from the form
            var userName = document.getElementById("userName").value;
            var userRating = document.getElementById("userRating").value;
            var userReview = document.getElementById("userReview").value;

            // Create a new list item with the user's review
            var reviewItem = document.createElement("li");
            reviewItem.classList.add("list-group-item");
            reviewItem.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">${userName}</div>
                            <div class="col-md-6">Rating: ${userRating}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">"${userReview}"</div>
                        </div>
                    `;

            // Append the new review to the list
            document.querySelector(".reviews").appendChild(reviewItem);

            // Reset the form
            document.getElementById("reviewForm").reset();
        });
    </script>
</body>

</html>