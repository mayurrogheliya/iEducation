<?php
// Retrieve the chapter value from URL parameter
if (isset($_GET['cname'])) {
    $cname = $_GET['cname'];
} else {
    // Handle case when chapter parameter is not provided
    // You can set a default value or display an error message
    $cname = "Default name";
}

// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['next2'])) {
    // Retrieve form data
    $point1 = $_POST['point1'];
    $point2 = $_POST['point2'];
    $point3 = $_POST['point3'];
    $point4 = $_POST['point4'];
    $point5 = $_POST['point5'];
    $chapter = $_POST['chapter'];

    $q = "INSERT INTO topic(point1, point2, point3,point4,point5,chapter,cname) VALUES ('$point1','$point2','$point3','$point4','$point5','$chapter','$cname')";
    if (mysqli_query($con, $q)) {
        header("Location: chapter.php?chapter=" . $chapter);
        exit();
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once("navbar.php")
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <h2>Enter the five main point to learn in this course</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?cname=<?php echo urlencode($cname); ?>" onsubmit="return check()" enctype="multipart/form-data">
                    <div class="mb-3 mt-4 ">
                        <input type="text" class="form-control" id="point1" name="point1" placeholder="Enter first point">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <input type="text" class="form-control" id="point2" name="point2" placeholder="Enter second point">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <input type="text" class="form-control" id="point3" name="point3" placeholder="Enter third point">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <input type="text" class="form-control" id="point4" name="point4" placeholder="Enter fourth point">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <input type="text" class="form-control" id="point5" name="point5" placeholder="Enter fifth point">
                    </div>
                    <div class="mb-3 mt-4 ">
                        <label for="chapter" class="form-label">How many chapter</label>
                        <input type="number" class="form-control" id="chapter" name="chapter" placeholder="How many chapter">
                    </div>
                    <p id="point_err"></p>
                    <button type="submit" name="next2" class="btn btn-primary ">Next →</button>

                </form>
            </div>
        </div>
    </div>

    <script>
        var point1 = document.getElementById('point1');
        var point2 = document.getElementById('point2');
        var point3 = document.getElementById('point3');
        var point4 = document.getElementById('point4');
        var point5 = document.getElementById('point5');
        var ch = document.getElementById('chapter');

        var point1_err = document.getElementById('point_err');

        function check() {
            if (point1.value == "" || point2.value == "" || point3.value == "" || point4.value == "" || point5.value == "" || ch.value == "") {
                point_err.style.color = 'red';
                point_err.innerHTML = 'Please filed the above blank filed';
                return false;
            } else {
                point_err.innerHTML = "";
                return true;
            }
        }
    </script>
</body>

</html>