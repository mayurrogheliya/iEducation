<?php
include_once("./backend/database.php");

if (isset($_POST['btn'])) {
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
            echo "Error: " . $q . "<br>" . mysqli_error($con);
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
                                <form onsubmit="return registervalidate()" action="register.php" class="mx-1 mx-md-4" method="post" enctype="multipart/form-data">
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

    <script src="./javascript/validation.js"></script>

</body>

</html>