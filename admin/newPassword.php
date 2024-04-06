<?php
session_start(); // Start the session
include_once("../backend/database.php");

if (isset($_POST['btn'])) {
    $pwd = $_POST['pswd'];

    // Check if session variables are set
    if (isset($_SESSION['forgot_email']) && isset($_SESSION['forgot_token'])) {
        $email = $_SESSION['forgot_email'];
        $token = $_SESSION['forgot_token'];

        $q = "update admin set a_password='$pwd' where a_email='$email'";
        if (mysqli_query($con, $q)) {
            $del = "delete from token where email='$email' and token='$token'";
            if (mysqli_query($con, $del)) {
                unset($_SESSION['forgot_email']);
                unset($_SESSION['forgot_token']);
                echo '<script>alert("Password changed successfully");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            } else {
                echo '<script>alert("Error occurred while deleting token");</script>';
            }
        } else {
            echo '<script>alert("Error occurred while updating password");</script>';
        }
    } else {
        echo '<script>alert("Session variables not set or expired");</script>';
    }
}
?>
<br>



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
                            <p class="text-center h3 fw-bold mb-4 mx-1 mx-md-4">Reset Password</p>
                            <div class="col-12">
                            </div>
                            <form action="newPassword.php" method="post" enctype="multipart/form-data" id="form1" onsubmit="return validateForm();">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="pwd" name="pswd" placeholder="New Password">
                                            <label for="pwd" class="form-label">New Password</label>
                                            <span id="pswd_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="repwd" name="repwd" placeholder="Repeat Password">
                                            <label for="repwd" class="form-label">Repeat Password</label>
                                            <span id="repswd_err"></span>
                                        </div>
                                    </div>
                                    <span id="err"></span>
                                    <div class="col-12 mt-2">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary btn-lg on" value="Submit" name="btn"></input>
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

    <script>
        function validateForm() {
            var newPassword = document.getElementById("pwd").value;
            var repeatPassword = document.getElementById("repwd").value;

            // Check if new password and repeat password fields are empty
            if (newPassword.trim() === "") {
                document.getElementById("pswd_err").textContent = "New password cannot be empty";
                document.getElementById("pswd_err").style.color = "red";
                return false;
            } else {
                document.getElementById("pswd_err").textContent = "";
            }

            if (repeatPassword.trim() === "") {
                document.getElementById("repswd_err").textContent = "Repeat password cannot be empty";
                document.getElementById("repswd_err").style.color = "red";
                return false;
            } else {
                document.getElementById("repswd_err").textContent = "";
            }

            // Check if repeat password matches new password
            if (newPassword !== repeatPassword) {
                document.getElementById("err").textContent = "Repeat password does not match the new password";
                document.getElementById("err").style.color = "red";
                return false;
            } else {
                document.getElementById("err").textContent = "";
            }

            return true;
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>