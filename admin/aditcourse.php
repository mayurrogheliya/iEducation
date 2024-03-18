<?php
include_once("../backend/database.php");

// Check if id parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch course data from the database based on the provided id
    $query = "SELECT * FROM course WHERE c_id = '$id'";
    $result = mysqli_query($con, $query);

    // Check if course exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            $cname = $_POST['cname'];
            $cdesc = $_POST['cdesc'];

            // Check if a new image file is uploaded
            if ($_FILES['cimage']['size'] > 0) {
                // Delete the old image file
                $old_image_path = "../CourseImage/" . $row['c_image'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the file
                }

                // Upload the new image file
                $image_name = $_FILES['cimage']['name'];
                $image_tmp = $_FILES['cimage']['tmp_name'];
                $image_path = "../CourseImage/" . $image_name;
                move_uploaded_file($image_tmp, $image_path);

                // Update course information in the database with the new image path
                $update_query = "UPDATE course SET c_name='$cname', c_desc='$cdesc', c_image='$image_name' WHERE c_id='$id'";
            } else {
                // Update course information in the database without changing the image path
                $update_query = "UPDATE course SET c_name='$cname', c_desc='$cdesc' WHERE c_id='$id'";
            }

            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "course information updated successfully";
                // Redirect to course.php or any other page
                header("Location: course.php");
            } else {
                echo "Error updating course information: " . mysqli_error($con);
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
            <div class="col-md-3 ">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="cname" class="form-label">Enter course name</label>
                        <input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['c_name']; ?>">
                        <p id="cname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="cimage" class="form-label">Select course image</label><br>
                        <img src="../CourseImage/<?php echo $row['c_image']; ?>" alt="course Image" style="min-width: 80px; max-width: 80px; min-height: 80px; max-height: 80px;"><br>
                        <input type="file" class="mt-2" id="cimage" name="cimage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="cdesc" class="form-label">Enter course description</label>
                        <textarea class="form-control" id="cdesc" name="cdesc" rows="3"><?php echo $row['c_desc']; ?></textarea>
                        <p id="cdesc_err"></p>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary ">Update Course</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        var cname = document.getElementById('cname');
        var cdesc = document.getElementById('cdesc');
        var cchpnum = document.getElementById('cchpnum');
        var cchpname = document.getElementById('cchpname');
        var cchpdf = document.getElementById('cchpdf');

        var cname_err = document.getElementById('cname_err');
        var cdesc_err = document.getElementById('cdesc_err');
        var cchpnum_err = document.getElementById('cchpnum_err');
        var cchpname_err = document.getElementById('cchpname_err');
        var cchpdf_err = document.getElementById('cchpdf_err');

        function check() {
            if (cname.value == "") {
                cname_err.style.color = 'red';
                cname_err.innerHTML = 'Please enter course name';
                cname.style.border = '1px solid red';
                var cnamer = false;
            } else {
                cname_err.innerHTML = "";
                cname.style.border = "1px solid #e3e6ea";
                cnamer = true;
            }

            if (cdesc.value == "") {
                cdesc_err.style.color = 'red';
                cdesc_err.innerHTML = 'Please enter course description';
                cdesc.style.border = '1px solid red';
                var cdescr = false;
            } else {
                cdesc_err.innerHTML = "";
                cdesc.style.border = "1px solid #e3e6ea";
                cdescr = true;
            }



            function chpdetail() {
                if (cchpnum.value == "") {
                    cchpnum_err.style.color = 'red';
                    cchpnum_err.innerHTML = 'Please enter how many chapter you upload in this course';
                    cchpnum.style.border = '1px solid red';
                    var cchpnumr = false;
                } else {
                    cchpnum_err.innerHTML = "";
                    cchpnum.style.border = "1px solid #e3e6ea";
                    cchpnumr = true;
                }

                if (cchpname.value == "") {
                    cchpname_err.style.color = 'red';
                    cchpname_err.innerHTML = 'Please enter chapter name';
                    cchpname.style.border = '1px solid red';
                    var cchpnamer = false;
                } else {
                    cchpname_err.innerHTML = "";
                    cchpname.style.border = "1px solid #e3e6ea";
                    cchpnamer = true;
                }

                if (cchpdf.files.length == 0) {
                    cchpdf_err.style.color = 'red';
                    cchpdf_err.innerHTML = 'Please enter chapter name';
                    cchpdf.style.border = '1px solid red';
                    var cchpdfr = false;
                } else {
                    cchpdf_err.innerHTML = "";
                    cchpdf.style.border = "1px solid #e3e6ea";
                    cchpdfr = true;
                }
            }

            if (cnamer == true && cimager == true && cdescr == true && cchpnumr == true && cchpnamer == true && cchpdfr == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>