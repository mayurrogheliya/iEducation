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
    include_once("navbar.php");
    include_once("../backend/database.php");
    $q = "SELECT * FROM admin";
    $result = mysqli_query($con, $q);
    $admin_name = "";
    if ($row = mysqli_fetch_assoc($result)) {
        $admin_name = $row['a_name'];
    }

    $query = "SELECT * FROM home WHERE id=1";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            // Retrieve updated form data
            $name = $_POST['name'];
            $title = $_POST['title'];
            $headline = $_POST['headline'];

            // Check if a new image file is uploaded
            if ($_FILES['image']['size'] > 0) {
                // Delete the old image file
                $old_image_path = "../uploads/" . $row['image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the file
                }

                // Upload the new image file
                $image_name = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_path = "../uploads/" . $image_name;
                move_uploaded_file($image_tmp, $image_path);

                // Update course information in the database with the new image path
                $update_query = "UPDATE home SET websiteName='$name', title='$title', headline='$headline', image='$image_name' WHERE id=1";
            } else {
                // Update course information in the database without changing the image path
                $update_query = "UPDATE home SET websiteName='$name', title='$title', headline='$headline' WHERE id=1";
            }

            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "Information updated successfully";
                // Redirect to course.php or any other page
                header("Location: admin.php");
            } else {
                echo "Error updating course information: " . mysqli_error($con);
            }
        }
    }


    ?>

    <div class="container-fluid mt-2">
        <div class="row">

            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <div class="jumbotron">
                    <h1>Welcome to the Admin Dashboard, <?php echo $admin_name; ?></h1>
                    <p style="font-size: 20px; letter-spacing: 2px;">Welcome to the Education Admin Dashboard, where you can efficiently manage courses, users, and comments to enhance the learning experience.</p>
                </div>

                <form action="admin.php" method="post" enctype="multipart/form-data" onsubmit="return check()">
                    <div class=" form-group">
                        <label for="name">Your website Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['websiteName']; ?>">
                        <p id="n_err"></p>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>">
                        <p id="t_err"></p>
                    </div>
                    <div class="form-group">
                        <label for="headline">Headline</label>
                        <textarea class="form-control" id="headline" name="headline" rows="2"><?php echo $row['headline']; ?></textarea>
                        <p id="h_err"></p>
                    </div>
                    <div class="form-group">
                        <img src="../uploads/<?php echo $row['image']; ?>" alt="Image" style="min-width: 300px; max-width:300px; min-height: 300px; max-height: 300px;"><br>
                        <input type="file" class="mt-2" id="image" name="image" accept="image/*, .gif">
                    </div>
                    <button type="submit" name="update" style="margin-bottom: 30px;" class="btn btn-primary">Edit</button>
                </form>

            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>
    <script>
        function check() {
            var name = document.getElementById('name');
            var title = document.getElementById('title');
            var headline = document.getElementById('headline');

            var n_err = document.getElementById('n_err');
            var t_err = document.getElementById('t_err');
            var h_err = document.getElementById('h_err');

            var isValid = true;

            if (name.value.trim() === "") {
                n_err.style.color = 'red';
                n_err.innerHTML = 'Please enter website name';
                name.style.border = '1px solid red';
                isValid = false;
            } else {
                n_err.innerHTML = "";
                name.style.border = "1px solid #e3e6ea";
            }
            if (title.value.trim() === "") {
                t_err.style.color = 'red';
                t_err.innerHTML = 'Please enter website title';
                title.style.border = '1px solid red';
                isValid = false;
            } else {
                t_err.innerHTML = "";
                title.style.border = "1px solid #e3e6ea";
            }
            if (headline.value.trim() === "") {
                h_err.style.color = 'red';
                h_err.innerHTML = 'Please enter website headline';
                headline.style.border = '1px solid red';
                isValid = false;
            } else {
                h_err.innerHTML = "";
                headline.style.border = "1px solid #e3e6ea";
            }

            return isValid;
        }
    </script>



</body>

</html>