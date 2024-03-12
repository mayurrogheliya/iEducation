<?php
// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['add'])) {
    // Retrieve form data
    $uname = $_POST['uname'];
    $uphone = $_POST['uphone'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    
    // Check if the directory exists, if not, create it
    $uploadDirectory = "../uploads/";
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // create directory with full permissions
    }

    // Handle file upload
    $file = $_FILES['uimage'];
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
        $q = "INSERT INTO register(u_name, u_phone, u_email, u_password, u_photo) VALUES ('$name', '$phone', '$email', '$pasword', '$newFileName')";
        if (mysqli_query($con, $q)) {
            echo "<script>alert('New record created successfully')</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: ". $q. "<br>". mysqli_error($con);
        }
    } else {
        echo "Error uploading file";
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
                <form method="post" action="adduser.php" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Enter user name</label>
                        <input type="text" class="form-control" name="uname" id="uname">
                        <p id="uname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uphone" class="form-label">Enter user phone number</label>
                        <input type="text" class="form-control" name="uphone" id="uphone">
                        <p id="uphone_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Enter user email</label>
                        <input type="text" class="form-control" id="uemail" name="uemail">
                        <p id="uemail_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="upassword" class="form-label">Enter user password</label>
                        <input type="password" class="form-control" name="upassword" id="upassword"> 
                        <input type="checkbox" class="mt-2" onclick="show()"> Show Password
                        <p id="upassword_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uimage" class="form-label">Select user image</label><br>
                        <input type="file" name="uimage" id="uimage" accept="image/*">
                        <p id="uimage_err"></p>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary ">Add User</button>
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
        var uimage = document.getElementById('uimage');

        var uname_err = document.getElementById('uname_err');
        var uphone_err = document.getElementById('uphone_err');
        var uemail_err = document.getElementById('uemail_err');
        var upassword_err = document.getElementById('upassword_err');
        var uimage_err = document.getElementById('uimage_err');

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

            if (uimage.value === "") {
                uimage_err.style.color = 'red';
                uimage_err.innerHTML = 'Please select user image';
                uimage.style.border = '1px solid red';
                uimager = false;
            } else {
                uimage_err.innerHTML = "";
                uimage.style.border = "1px solid #e3e6ea";
                uimager = true;
            }

            return (unamer && uphoner && uemailr && upasswordr && uimager);
        }
    </script>
</body>

</html>