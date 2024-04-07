<?php
session_start();
if (isset($_SESSION['uemail'])) {
    header("location: home.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/Exception.php');

include_once("./backend/database.php");

if (isset($_POST['btn'])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $token = uniqid() . uniqid();

    $uploadDirectory = "./uploads/";
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $file = $_FILES['photo'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid('', true) . '.' . $fileExt;
    $destination = $uploadDirectory . $newFileName;

    if (move_uploaded_file($fileTmpName, $destination)) {
        $check_query = "SELECT * FROM register WHERE u_email='$email'";
        $result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists. Please use a different email.')</script>";
        } else {
            $q = "INSERT INTO register(u_name, u_phone, u_email, u_password, u_photo, token) VALUES ('$name', '$phone', '$email', '$password', '$newFileName','$token')";
            if (mysqli_query($con, $q)) {

                $mail = new PHPMailer();
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mrogheliya585@rku.ac.in';
                    $mail->Password = '';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('mrogheliya585@rku.ac.in', 'Mayur Rogheliya');
                    $mail->addAddress($email, $name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Account Verification';
                    $mail->Body = 'Congratulations! ' . $name . ' Your account has been created successfully. This email is for your account verification. <br> Kindly click on the link below to verify your account. You will be able to login into your account only after account verification. <br>
            <a href="http://localhost/web%20programming/iEducation/verify_account.php?email=' . $email . '&token=' . $token . '">Click here to verify your account</a>';

                    if ($mail->send()) {
                        setcookie("success", "Registration Successfull. Activation mail is sent to your registered email account. Kindly activate your account to login.", time() + 2, "/");
                        header("Location: login.php");
                        exit();
                    } else {
                        setcookie("error", "Error in sending mail. Please try again later.", time() + 2, "/");
                        header("Location: register.php");
                        exit();
                    }
                } catch (Exception $e) {
                    echo "Email sending failed. Error: {$mail->ErrorInfo}";
                }

                echo "<script>alert('New record created successfully')</script>";
            } else {
                echo "Error: " . $q . "<br>" . mysqli_error($con);
            }
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
    <?php include_once("header.php"); ?>
    <section class="m-5">
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