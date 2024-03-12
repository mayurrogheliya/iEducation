<?php
include_once("./backend/database.php");

if(isset($_POST['btn'])){
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $pasword = $_POST["password"];
    
    // Check if the directory exists, if not, create it
    $uploadDirectory = "./uploads/";
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // create directory with full permissions
    }

    // Handle file upload
    $file = $_FILES['photo'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>


<body>
    <?php
    include_once("header.php");
    ?>
    <section class="m-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card border border-light-subtle rounded-3 shadow-sm col-lg-7 col-xl-6 col-md-9">
                    <div class="card-body p-md-3">
                        <div class="row justify-content-center">
                            <div class="col-12 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-3">Sign up</p>
                                <form onsubmit="return validate()" action="register.php" class="mx-1 mx-md-4" method="post" enctype="multipart/form-data">
                                    <!-- name -->
                                    <div class="d-flex flex-row  align-items-center">
                                        <div>
                                            <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill mb-1">
                                            <input name='name' id='name' type="text" class="form-control" style="font-size: 18px;" placeholder="Enter your name" />
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="name_err"></p>
                                    <!-- phone -->
                                    <div class="d-flex flex-row align-items-center">
                                        <div>
                                            <i class="fa fa-phone fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill">
                                            <input name='phone' id='phone' type="text" class="form-control" style="font-size: 18px;" placeholder="Enter your phone" />
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="phone_err"></p>
                                    <!-- gender -->
                                    <!-- <div class="d-flex flex-row align-items-center">
                                        <div>
                                            <i class="fa fa-venus-mars fa-lg me-3 fa-fw "></i>
                                        </div>
                                        <div class="form-outline flex-fill ">
                                            <input type="radio" name="gender" value="male">Male
                                            <input type="radio" name="gender" value="female">Female
                                        </div>
                                    </div> -->
                                    <p style="padding-left: 45px;" id="gender_err"></p>
                                    <!-- email -->
                                    <div class="d-flex flex-row  align-items-center">
                                        <div>
                                            <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill mb-1">
                                            <input name='email' id='email' type="text" class="form-control" style="font-size: 18px;" placeholder="Enter your email" />
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="email_err"></p>
                                    <!-- password -->
                                    <div class="d-flex flex-row  align-items-center">
                                        <div>
                                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill mb-1">
                                            <input name='password' id='password' type="password" class="form-control" style="font-size: 18px;" placeholder='Enter your password' />
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="password_err"></p>
                                    <!-- cpassword -->
                                    <div class="d-flex flex-row  align-items-center">
                                        <div>
                                            <i class="fa fa-key fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill mb-1">
                                            <input name='cpassword' id='cpassword' type="password" class="form-control" style="font-size: 18px;" placeholder='Repeat your password' />
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="cpassword_err"></p>
                                    <!-- file -->
                                    <div class="d-flex flex-row align-items-center mt-3">
                                        <div>
                                            <i class="fa fa-picture-o fa-lg me-3 fa-fw"></i>
                                        </div>
                                        <div class="form-outline flex-fill mb-1">
                                            <input type="file" name="photo" id="photo" class="form-control" style="font-size: 18px;" accept="image/*">
                                        </div>
                                    </div>
                                    <p style="padding-left: 45px;" id="file_err"></p>
                                    <div class="d-flex justify-content-start mb-2 mb-lg-2">
                                        <button type="submit" class="btn btn-primary btn-lg" name="btn">Register</button>
                                    </div>
                                    <p id="completion" style="display: none; color:green;">Registration successfully complete</p>
                                    <p class="mt-3 text-secondary text-center  ">
                                        <a href="login.php" class="link-primary text-decoration-underline ">Already
                                            Register</a>
                                    </p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ffile = document.getElementById('photo');
        var frfile = document.getElementById('file_err');

        var fn = document.getElementById("name");
        var fp = document.getElementById("phone");
        var fe = document.getElementById("email");
        var fpas = document.getElementById("password");
        var fcpas = document.getElementById("cpassword");

        var frn = document.getElementById("name_err");
        var frp = document.getElementById("phone_err");
        var fre = document.getElementById("email_err");
        var frpas = document.getElementById("password_err");
        var frcpas = document.getElementById("cpassword_err");

        var completion = document.getElementById("completion");

        function validate() {
            if (ffile.value == "") {
                frfile.innerHTML = "Please upload the file";
                frfile.style.color = "red";
                ffile.style.border = "1px solid red";
                var v_ff = false
            } else {
                frfile.innerHTML = "";
                frfile.style.color = "";
                ffile.style.border = "";
                var v_ff = true
            }

            if (fn.value == "") {
                frn.innerHTML = "Please enter the name";
                frn.style.color = "red";
                fn.style.border = "1px solid red";
                var v_fn = false
            } else {
                var reg_fn = /^[a-zA-Z ]{2,30}$/;
                var result = reg_fn.test(fn.value);
                if (result == false) {
                    frn.innerHTML = "Name contains only letters and minimum length is 2 characters and maximum length is 30 character"
                    frn.style.color = "red";
                    fn.style.border = "1px solid red";
                    v_fn = false
                } else {
                    frn.innerHTML = "";
                    fn.style.border = "1px solid #e3e6ea";
                    v_fn = true;
                }
            }

            if (fp.value == "") {
                frp.innerHTML = "Please enter the phone number";
                frp.style.color = "red";
                fp.style.border = "1px solid red";
                var v_fp = false
            } else {
                var reg_fp = /^[\d]{10}$/;
                var result = reg_fp.test(fp.value);
                if (result == false) {
                    frp.innerHTML = "Mobile number containe only 10 digist"
                    frp.style.color = "red";
                    fp.style.border = "1px solid red";
                    v_fp = false
                } else {
                    frp.innerHTML = "";
                    fp.style.border = "1px solid #e3e6ea";
                    v_fp = true;
                }
            }

            if (fe.value == "") {
                fre.innerHTML = "Please enter the email";
                fre.style.color = "red";
                fe.style.border = "1px solid red";
                var v_fe = false
            } else {
                var reg_fe = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/
                var result = reg_fe.test(fe.value);
                if (result == false) {
                    fre.innerHTML = "Enter email is not proper"
                    fre.style.color = "red";
                    fe.style.border = "1px solid red";
                    v_fe = false
                } else {
                    fre.innerHTML = "";
                    fe.style.border = "1px solid #e3e6ea";
                    v_fe = true;
                }

            }

            if (fpas.value == "") {
                frpas.innerHTML = "Please enter the password";
                frpas.style.color = "red";
                fpas.style.border = "1px solid red";
                var v_fpas = false
            } else {
                var reg_fpas = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                var result = reg_fpas.test(fpas.value);
                if (result == false) {
                    frpas.innerHTML = "Please enter the strong password"
                    frpas.style.color = "red";
                    fpas.style.border = "1px solid red";
                    v_fpas = false
                } else {
                    frpas.innerHTML = "";
                    fpas.style.border = "1px solid #e3e6ea";
                    v_fpas = true;
                }
            }

            if (fcpas.value != fpas.value || fcpas.value == "") {
                frcpas.innerHTML = "Password is not match"
                frcpas.style.color = "red";
                fcpas.style.border = "1px solid red";
                var v_fcpas = false
            } else {
                frcpas.innerHTML = "";
                fcpas.style.border = "1px solid #e3e6ea";
                v_fcpas = true;
            }

            if (v_fn == true && v_ff == true && v_fp == true && v_fe == true && v_fpas == true && v_fcpas == true && v_ff == true) {
                return true
                completion.style.display = "block";
            } else {
                return false
            }
        }
    </script>

</body>

</html>