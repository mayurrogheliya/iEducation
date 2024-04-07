<?php
session_start();
if (!isset($_SESSION['uemail'])) {
    include_once("header.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/universe.css">
</head>

<body>
    <?php
    include_once("header.php");
    include_once("./backend/database.php");

    $q = "SELECT * FROM home";
    $result = mysqli_query($con, $q);

    ?>
    <section class="py-5 py-xl-8" id="home">
        <div class="container mt-5">
            <div class="row">
                <?php
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-start order-md-0 order-1">
                            <h1 class="fw-bold mb-4" style="font-size: 2.5rem;"><?php echo $row['title']; ?></h1>
                            <h4 class="mb-4" style="line-height: 1.8;"><?php echo $row['headline']; ?></h4>
                            <a class="btn btn-primary fs-5" href="course.php">Get Started <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="col-md-6 col-12 d-flex justify-content-center align-items-center order-md-1 order-0">
                            <figure>
                                <img src="./uploads/<?php echo $row['image']; ?>" class="img-fluid" style="min-height: 300px; min-width: 400px;" alt="Image">
                            </figure>
                        </div>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>Unknown</td></tr>";
                } ?>
            </div>
        </div>
    </section>


</body>

</html>