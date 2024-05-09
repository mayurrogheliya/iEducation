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
</head>

<body>
    <?php
    include_once("header.php");
    include_once("./backend/database.php");

    $q = "SELECT * FROM about";
    $result = mysqli_query($con, $q);
    ?>
    <section class="py-5 py-xl-8" id="about">
        <div class="container">
            <div class="row d-flex justify-content-center ">
                <h2 class="text-center ">Why Choose Us</h2>
                <div class="col-lg-10 col-xl-10 col-md-10">
                    <p class="fs-5 text-center">"Choose us for unparalleled educational excellence,
                        diverse
                        courses,
                        expert faculty, interactive
                        learning, and a
                        commitment to your academic success. Join a transformative educational journey today!"
                    </p>
                </div>
            </div>
            <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
        </div>

        <div class="container overflow-hidden">
            <div class="row gy-4 gy-xl-0">
                <?php
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row of the result
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-12 col-sm-6 col-xl-3 col-md-5">
                            <div class="card border-0 border-bottom border-primary shadow-sm">
                                <div class="card-body text-center p-2 p-xxl-3">
                                    <img src="./uploads/<?php echo $row['image']; ?>" class="w-50" alt="image">
                                    <h4 class="mb-4"><?php echo $row['title']; ?></h4>
                                    <p class="mb-4 text-secondary fs-5"><?php echo $row['description']; ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'></td></tr>";
                }
                ?>

            </div>
        </div>
    </section>

</body>

</html>