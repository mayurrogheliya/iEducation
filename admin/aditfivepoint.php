<?php
include_once("../backend/database.php");

// Check if id parameter is provided in the URL
if (isset($_GET['cname'])) {
    $cname = $_GET['cname'];

    // Fetch topic data from the database based on the provided id
    $query = "SELECT * FROM topic WHERE cname = '$cname'";
    $result = mysqli_query($con, $query);

    // Check if topic exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            $point1 = $_POST['point1'];
            $point2 = $_POST['point2'];
            $point3 = $_POST['point3'];
            $point4 = $_POST['point4'];
            $point5 = $_POST['point5'];

            // Update topic information in the database
            $update_query = "UPDATE topic SET point1='$point1', point2='$point2', point3='$point3', point4='$point4', point5='$point5' WHERE cname='$cname'";
            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "Topic information updated successfully";
                // Redirect to appropriate page
                header("Location: course.php");
            } else {
                echo "Error updating topic information: " . mysqli_error($con);
            }
        }
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
                <form method="post" enctype="multipart/form-data" onsubmit="return check()">
                    <div class="mb-3 mt-4 ">
                        <label for="point1" class="form-label">Enter first point</label>
                        <input type="text" class="form-control" id="point1" name="point1" value="<?php echo $row['point1']; ?>">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <label for="point2" class="form-label">Enter second point</label>
                        <input type="text" class="form-control" id="point2" name="point2" value="<?php echo $row['point2']; ?>">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <label for="point3" class="form-label">Enter third point</label>
                        <input type="text" class="form-control" id="point3" name="point3" value="<?php echo $row['point3']; ?>">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <label for="point4" class="form-label">Enter fourth point</label>
                        <input type="text" class="form-control" id="point4" name="point4" value="<?php echo $row['point4']; ?>">
                    </div>

                    <div class="mb-3 mt-4 ">
                        <label for="point5" class="form-label">Enter fifth point</label>
                        <input type="text" class="form-control" id="point5" name="point5" value="<?php echo $row['point5']; ?>">
                    </div>
                    <p id="point_err"></p>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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