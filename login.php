<?php
session_start();
if (isset($_SESSION['uemail'])) {
    header("location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include_once("./backend/database.php");
    $login_err = "";
    $active_err = "";
    if (isset($_POST['submit'])) {
        $email = $_POST['uemail'];
        $password = $_POST['password'];
        $query = "SELECT * FROM register WHERE u_email = '$email' AND u_password = '$password'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            while ($a = mysqli_fetch_array($result)) {
                $status = $a[7];
                if ($status == "Active") {
                    $_SESSION['uemail'] = $email;
                    header("Location: home.php");
                } else {
                    $active_err = "Account is not activated. Kindly activate your account by clicking on the activation link sent to your email address";
                }
            }
        } else {
            $login_err = "Invalid email or password.";
        }
    }
    ?>

    <?php
    include_once("header.php");
    ?>

    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <p style="color: red; font-weight: bold;"><?php echo $active_err; ?></p>

                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 px-xl-5">
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4">Login</p>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
                            <div class="col-12">
                                <p style="color: red; font-weight: bold;"><?php echo $login_err; ?></p>
                            </div>
                            <form method="post" action="login.php" onsubmit="return loginvalidate()">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="uemail" id="email" placeholder="name@example.com" />
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        <p id="email_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating ">
                                            <input type="text" class="form-control" name="password" id="password" placeholder="Password" />
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                        <p id="password_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <a href="forgotPassword.php" class="link-primary text-decoration-underline">Forgot password</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" name="submit" type="submit" class="btn btn-primary btn-lg on">Log in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Don't have an account?
                                            <a href="register.php" class="link-primary text-decoration-underline ">
                                                Sign up
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

    <!-- <script src="./javascript/validation.js"></script> -->
    <script>
        function loginvalidate() {
            let ue = document.getElementById("email");
            let ue_err = document.getElementById("email_err");
            let up = document.getElementById("password");
            let up_err = document.getElementById("password_err");

            if (ue.value == "") {
                ue_err.innerHTML = "* Please enter the email";
                ue_err.style.color = "red";
                ue.style.border = "1px solid red";
                var uec = false;
            } else {
                ue_err.innerHTML = "";
                ue.style.border = "1px solid #e3e6ea";
                uec = true;
            }

            if (up.value == "") {
                up_err.innerHTML = "* Please enter the password";
                up_err.style.color = "red";
                up.style.border = "1px solid red";
                var upc = false;
            } else {
                up.style.border = "1px solid #e3e6ea";
                up_err.innerHTML = ""
                upc = true;
            }

            if (uec == true && upc == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>