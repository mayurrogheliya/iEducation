<?php
include_once("../backend/database.php");

// Check if email parameter is provided in the URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch user data from the database based on the provided email
    $query = "SELECT * FROM register WHERE u_email = '$email'";
    $result = mysqli_query($con, $query);

    // Check if user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            $uname = $_POST['uname'];
            $uphone = $_POST['uphone'];
            $upassword = $_POST['upassword'];

            // Check if a new image file is uploaded
            if ($_FILES['uimage']['size'] > 0) {
                // Delete the old image file
                $old_image_path = "../uploads/" . $row['u_photo'];
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the file
                }

                // Upload the new image file
                $image_name = $_FILES['uimage']['name'];
                $image_tmp = $_FILES['uimage']['tmp_name'];
                $image_path = "../uploads/" . $image_name;
                move_uploaded_file($image_tmp, $image_path);

                // Update user information in the database with the new image path
                $update_query = "UPDATE register SET u_name='$uname', u_phone='$uphone', u_password='$upassword', u_photo='$image_name' WHERE u_email='$email'";
            } else {
                // Update user information in the database without changing the image path
                $update_query = "UPDATE register SET u_name='$uname', u_phone='$uphone', u_password='$upassword' WHERE u_email='$email'";
            }

            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "User information updated successfully";
                // Redirect to user.php or any other page
                header("Location: user.php");
            } else {
                echo "Error updating user information: " . mysqli_error($con);
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
    <style>
        .rounded-img {
            /* border-radius: 50%; */
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
    <?php
    include_once("navbar.php")
    ?>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php include_once("header.php"); ?>
            </div>
            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Enter user name</label>
                        <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $row['u_name']; ?>">
                        <p id="uname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uphone" class="form-label">Enter user phone number</label>
                        <input type="text" class="form-control" id="uphone" name="uphone" value="<?php echo $row['u_phone']; ?>">
                        <p id="uphone_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Enter user email</label>
                        <input type="text" class="form-control" id="uemail" name="uemail" value="<?php echo $row['u_email']; ?>" disabled>
                        <p id="uemail_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="upassword" class="form-label">Enter user password</label>
                        <input type="password" class="form-control" id="upassword" name="upassword" value="<?php echo $row['u_password']; ?>">
                        <input type="checkbox" class="mt-2" onclick="show()"> Show Password
                        <p id="upassword_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uimage" class="form-label">Select user image</label><br>
                        <img src="../uploads/<?php echo $row['u_photo']; ?>" alt="User Image" class="rounded-img"><br>
                        <input type="file" class="mt-2" id="uimage" name="uimage" accept="image/*">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary ">Update User</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    
    <script>
        function show() {
            var x = document.getElementById("upassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        var uname = document.getElementById('uname');
        var uphone = document.getElementById('uphone');
        var uemail = document.getElementById('uemail');
        var upassword = document.getElementById('upassword');

        var uname_err = document.getElementById('uname_err');
        var uphone_err = document.getElementById('uphone_err');
        var uemail_err = document.getElementById('uemail_err');
        var upassword_err = document.getElementById('upassword_err');

        function check() {
            if (uname.value === "") {
                uname_err.style.color = 'red';
                uname_err.innerHTML = 'Please enter user name';
                uname.style.border = '1px solid red';
                unamer = false;
            } else {
                uname_err.innerHTML = "";
                uname.style.border = "1px solid #e3e6ea";
                unamer = true;
            }

            if (uphone.value === "") {
                uphone_err.style.color = 'red';
                uphone_err.innerHTML = 'Please enter user phone number';
                uphone.style.border = '1px solid red';
                uphoner = false;
            } else {
                var reg_fp = /^[\d]{10}$/;
                var result = reg_fp.test(uphone.value);
                if (result == false) {
                    uphone_err.innerHTML = "Mobile number containe only 10 digist"
                    uphone_err.style.color = "red";
                    uphone.style.border = "1px solid red";
                    uphoner = false
                } else {
                    uphone_err.innerHTML = "";
                    uphone.style.border = "1px solid #e3e6ea";
                    uphoner = true;
                }
            }

            if (uemail.value === "") {
                uemail_err.style.color = 'red';
                uemail_err.innerHTML = 'Please enter user email';
                uemail.style.border = '1px solid red';
                var uemailr = false;
            } else {
                var reg_fe = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/
                var result = reg_fe.test(uemail.value);
                if (result == false) {
                    uemail_err.innerHTML = "Enter email is not proper"
                    uemail_err.style.color = "red";
                    uemail.style.border = "1px solid red";
                    uemailr = false
                } else {
                    uemail_err.innerHTML = "";
                    uemail.style.border = "1px solid #e3e6ea";
                    uemailr = true;
                }
            }

            if (upassword.value === "") {
                upassword_err.style.color = 'red';
                upassword_err.innerHTML = 'Please enter user password';
                upassword.style.border = '1px solid red';
                var upasswordr = false;
            } else {
                var reg_fpas = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                var result = reg_fpas.test(upassword.value);
                if (result == false) {
                    upassword_err.innerHTML = "Please enter the strong password"
                    upassword_err.style.color = "red";
                    upassword.style.border = "1px solid red";
                    upasswordr = false
                } else {
                    upassword_err.innerHTML = "";
                    upassword.style.border = "1px solid #e3e6ea";
                    upasswordr = true;
                }
            }

            return (unamer && uphoner && uemailr && upasswordr);
        }
    </script>
</body>
</html>
<?php
    } else {
        echo "User not found";
    }
    } else {
        echo "Email parameter not provided";
}
?>