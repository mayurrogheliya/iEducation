<?php
include_once("../backend/database.php");

// Check if id parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch about data from the database based on the provided id
    $query = "SELECT * FROM about WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    // Check if about exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            $title = $_POST['title'];
            $desc = $_POST['desc'];

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

                // Update about information in the database with the new image path
                $update_query = "UPDATE about SET title='$title', description='$desc', image='$image_name' WHERE id='$id'";
            } else {
                // Update about information in the database without changing the image path
                $update_query = "UPDATE about SET title='$title', description='$desc' WHERE id='$id'";
            }

            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "about information updated successfully";
                // Redirect to about.php or any other page
                header("Location: about.php");
            } else {
                echo "Error updating about information: " . mysqli_error($con);
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
    include_once("navbar.php");
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <form method="post" onsubmit="return check()" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $row['title']; ?>">
                        <p id="title_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" name="desc" id="desc" rows="3"><?php echo $row['description']; ?></textarea>
                        <p id="desc_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select image</label><br>
                        <img src="../uploads/<?php echo $row['image']; ?>" alt="Image" style="min-width: 80px; max-width: 80px; min-height: 80px; max-height: 80px;"><br>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary ">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        var title = document.getElementById('title');
        var desc = document.getElementById('desc');

        var title_err = document.getElementById('title_err');
        var desc_err = document.getElementById('desc_err');

        function check() {
            if (title.value == "") {
                title_err.style.color = 'red';
                title_err.innerHTML = 'Please enter title';
                title.style.border = '1px solid red';
                var namer = false;
            } else {
                title_err.innerHTML = "";
                title.style.border = "1px solid #e3e6ea";
                namer = true;
            }

            if (desc.value == "") {
                desc_err.style.color = 'red';
                desc_err.innerHTML = 'Please enter description';
                desc.style.border = '1px solid red';
                var descr = false;
            } else {
                desc_err.innerHTML = "";
                desc.style.border = "1px solid #e3e6ea";
                descr = true;
            }


            if (namer == true && descr == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>