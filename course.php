<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include_once("header.php");
    include_once("./backend/database.php");

    $q = "SELECT * FROM course";
    $result = mysqli_query($con, $q);
    ?>
    <section class="py-5 py-xl-8" id="course">
        <div class="container">
            <div class="row d-flex justify-content-center ">
                <h2 class="text-center ">Featured Courses</h2>
                <div class="col-lg-10 col-xl-10 col-md-10">
                    <p class="fs-5 text-center">"Explore our diverse collection of enriching courses designed to
                        foster
                        knowledge,
                        skills, and personal
                        growth. Unlock
                        your potential with our featured educational content today."</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col">
                            <div class="card">
                                <img src="./CourseImage/<?php echo $row['c_image']; ?>" class="card-img-top cardimage" alt="course image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['c_name']; ?></h5>
                                    <p class="card-text"><?php echo $row['c_desc']; ?></p>
                                    <a href="chtml.php" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No courses available</td></tr>";
                }
                ?>
            </div>
        </div>
    </section>

</body>

</html>