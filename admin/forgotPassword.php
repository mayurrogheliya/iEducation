<?php
session_start();
include_once("../backend/database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');
$forgot_err = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $q = "select * from admin where a_email='$email'";
    $result = mysqli_query($con, $q);

    $count = mysqli_num_rows($result);
    if ($count == 1) {

        $q1 = "select * from token where email='$email'";
        $countem = mysqli_num_rows(mysqli_query($con, $q1));
        if ($countem == 1) {
            $forgot_err = "OTP for resetting password is sent to your registered email address. New OTP will be generated if old OTP expires";
            // Set session variables
            $_SESSION['forgot_email'] = $email;
            $_SESSION['forgot_token'] = $token;
?>
            <script>
                window.location.href = "forgotPasswordOtp.php";
            </script>
            <?php
        } else {
            date_default_timezone_set("Asia/Kolkata");
            $s_time = date("Y-m-d G:i:s");

            $token = hash('sha512', $s_time);
            $otp = mt_rand(100000, 999999);
            $ins_token = "INSERT INTO token(email, s_time, token, otp) VALUES ('$email','$s_time','$token',$otp)";
            // echo "$ins_token";

            if (mysqli_query($con, $ins_token)) {

                $mail = new PHPMailer();
                try {

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mrogheliya585@rku.ac.in';
                    $mail->Password = '';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    // $mail->SMTPDebug = 2;
                    $_SESSION['forgot_email'] = $email;
                    $_SESSION['forgot_token'] = $token;
                    $mail->setFrom('mrogheliya585@rku.ac.in', 'Mayur Rogheliya');
                    while ($row = mysqli_fetch_array($result)) {
                        $mail->addAddress($email, $row[1]);
                    }

                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset';
                    $mail->Body = 'Your otp to reset your account password is ' . $otp;

                    // Send the email
                    if ($mail->send()) {
                        $forgot_err = "OTP to reset your password is sent to your email address";
            ?>
                        <script>
                            window.location.href = "forgotPasswordOtp.php";
                        </script>
                    <?php
                    } else {
                        $forgot_err = "Error in sending OTP. Please try again later.";
                    ?>
                        <script>
                            window.location.href = "forgotPassword.php";
                        </script>
<?php
                    }
                } catch (Exception $e) {
                    $forgot_err = "Email sending failed. Error: {$mail->ErrorInfo}";
                }
            }
        }
    } else {
        $forgot_err = 'Email id is not registered'; // Set error message if email is not registered
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 px-xl-5">
                            <h2 class="fs-5 fw-normal text-center text-secondary mb-4">Enter your email address to reset your password</h2>
                            <div class="col-12">
                            </div>
                            <form method="post" action="forgotPassword.php" onsubmit="return forgotPasswordValidate()">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com" />
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        <p style="color: red; font-weight: bold;" id="email_error"><?php echo $forgot_err; ?></p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="d-grid">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg on">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Remember your password?
                                            <a href="login.php" class="link-primary text-decoration-underline ">
                                                Log in
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function forgotPasswordValidate() {
            var email = document.getElementById('email');
            var emailError = document.getElementById('email_error');

            if (email.value == '') {
                emailError.textContent = 'Please enter your email';
                email.style.border = '1px solid red';
                return false;
            } else {
                emailError.textContent = '';
                email.style.border = "1px solid #e3e6ea";
                return true;
            }
        }
    </script>

</body>

</html>