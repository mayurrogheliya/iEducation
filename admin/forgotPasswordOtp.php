<?php
session_start(); // Start the session
include_once("../backend/database.php");

if (isset($_POST['btn'])) {
    $otp = $_POST['otp'];

    // Check if session variables are set
    if (isset($_SESSION['forgot_email']) && isset($_SESSION['forgot_token'])) {
        $email = $_SESSION['forgot_email'];
        $token = $_SESSION['forgot_token'];

        $q = "select * from token where email='$email' and token='$token'";
        $result = mysqli_query($con, $q);

        // Check if OTP matches
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($otp == $row['otp']) {
                // Redirect to newPassword.php if OTP is correct
                header("Location: newPassword.php");
                exit;
            } else {
                // Set error message and redirect back to forgotPasswordOtp.php
                $_SESSION['error'] = "Incorrect OTP";
                header("Location: forgotPasswordOtp.php");
                exit;
            }
        } else {
            // Set error message and redirect back to forgotPasswordOtp.php
            $_SESSION['error'] = "Session variables not set or expired";
            header("Location: forgotPasswordOtp.php");
            exit;
        }
    } else {
        // Set error message and redirect back to forgotPasswordOtp.php
        $_SESSION['error'] = "Session variables not set or expired";
        header("Location: forgotPasswordOtp.php");
        exit;
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
                            <p class="text-center h3 fw-bold mb-4 mx-1 mx-md-4">OTP Verification</p>
                            <div class="col-12"></div>
                            <form action="forgotPasswordOtp.php" method="post" id="form1">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="otp1" name="otp" placeholder="Enter OTP">
                                            <label for="otp1" class="form-label">Enter OTP</label>
                                            <span id="otp_err" style="color: red;"><?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?></span>
                                            <?php unset($_SESSION['error']); ?> <!-- Clear error message after displaying -->
                                        </div>
                                        <div class="mt-3">OTP will expire in <span id="timer">01:00</span></div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="d-grid gap-2 d-md-flex">
                                            <input type="submit" class="btn btn-primary equal-width-btn me-md-2" value="Verify OTP" name="btn">
                                            <a href="resendOtp.php"><input type="button" class="btn btn-primary equal-width-btn" value="Resend OTP" name="resend_btn" id="r_btn" disabled></a>
                                        </div>
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
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }
        window.onload = function() {
            var oneMinute = 60,
                display = document.getElementById('timer'); // Removed '#' as it's an ID not a CSS selector

            startTimer(oneMinute, display);
        };

        function enable_reset_btn() {
            document.getElementById("r_btn").disabled = false;
        }
        setTimeout(enable_reset_btn, 60000);
    </script>
</body>

</html>