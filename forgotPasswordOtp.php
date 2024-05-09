<?php
session_start();
include_once("header.php");
include_once("./backend/database.php");

if (isset($_POST['btn'])) {
    $otp = $_POST['otp'];

    $email = $_SESSION['forgot_email'];
    $token = $_SESSION['forgot_token'];

    $q = "SELECT * FROM token where email='$email' and token='$token'";
    $result = mysqli_query($con, $q);

    while ($row = mysqli_fetch_array($result)) {
        if ($otp == $row[3]) {
?>
            <script>
                window.location.href = "newPassword.php";
            </script>
        <?php
        } else {
            echo '<script>alert("Incorrect OTP")</script>';
        ?>
            <script>
                window.location.href = "forgotPasswordOtp.php";
            </script>
<?php
        }
    }
}
?>

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
            display = document.getElementById('#timer');

        startTimer(oneMinute, display);
    };

    function enable_reset_btn() {
        document.getElementById("r_btn").disabled = false;
    }
    setTimeout(enable_reset_btn, 60000);
</script>

<section class="py-5 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <div class="card border border-light-subtle rounded-3 shadow-sm">
                    <div class="card-body p-3 p-md-4 px-xl-5">
                        <p class="text-center h3 fw-bold mb-4 mx-1 mx-md-4">OTP Verification</p>
                        <div class="col-12">
                        </div>
                        <form action="forgotPasswordOtp.php" method="post" id="form1">
                            <div class="row gy-2 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="otp1" name="otp" placeholder="Enter OTP">
                                        <label for="otp1" class="form-label">Enter OTP</label>
                                        <span id="otp_err"></span>
                                    </div>
                                    <p style="color: red; font-weight: bold;" id="otp_error"></p>
                                    <div class="mt-3">OTP will expire in <span id="timer">01:00</span></div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="d-grid gap-2 d-md-flex">
                                        <input type="submit" class="btn btn-primary equal-width-btn me-md-2" value="Verify OTP" name="btn"></input>
                                        <a href="resendOtp.php"><input type="button" class="btn btn-primary equal-width-btn" value="Resend OTP" name="resend_btn" id="r_btn" disabled></input></a>
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

<script script>
    document.getElementById("form1").addEventListener("submit", function(event) {
        var otpValue = document.getElementById("otp1").value;
        if (otpValue.trim() === "") {
            event.preventDefault(); // Prevent form submission
            document.getElementById("otp_err").textContent = "Please enter OTP"; // Display error message
            document.getElementById("otp_err").style.color = "red"; // Display error message
        }
    });
</script>