<?php
// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['add'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    // Check if the directory exists, if not, create it
    $uploadDirectory = "../uploads/";
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // create directory with full permissions
    }

    // Handle file upload
    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Get file extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate a unique file name to prevent overwriting files with the same name
    $newFileName = uniqid('', true) . '.' . $fileExt;

    // Specify the destination directory for the uploaded file
    $destination = $uploadDirectory . $newFileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($fileTmpName, $destination)) {
        // Insert data into the database
        $q = "INSERT INTO about(title, description, image) VALUES ('$title', '$desc', '$newFileName')";
        if (mysqli_query($con, $q)) {
            echo "<script>alert('New record created successfully')</script>";
            header("Location: about.php");
            exit();
        } else {
            echo "Error: " . $q . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Error uploading file $fileError";
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
                <form method="post" action="addabout.php" onsubmit="return check()" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <p id="title_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                        <p id="desc_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select image</label><br>
                        <input type="file" name="image" id="image" accept="image/*">
                        <p id="image_err"></p>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary ">Add</button>
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
        var image = document.getElementById('image');
        var desc = document.getElementById('desc');

        var title_err = document.getElementById('title_err');
        var image_err = document.getElementById('image_err');
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

            if (image.files.length == 0) {
                image_err.style.color = 'red';
                image_err.innerHTML = 'Please select image';
                image.style.border = '1px solid red';
                var imager = false;
            } else {
                image_err.innerHTML = "";
                image.style.border = "1px solid #e3e6ea";
                imager = true;
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


            if (namer == true && imager == true && descr == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>