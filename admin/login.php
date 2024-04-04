<?php
session_start();
if (isset($_SESSION['email'])) {
    header("location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEducation - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once("../backend/database.php");
    $login_err = "";
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM admin WHERE a_email = '$email' AND a_password = '$password'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['email'] = $email;
            header("Location: admin.php");
        } else {
            $login_err = "Invalid email or password.";
        }
    }
    ?>

    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 px-xl-5">
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4">Admin Login</p>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
                            <div class="col-12">
                                <p style="color: red; font-weight: bold;"><?php echo $login_err; ?></p>
                            </div>
                            <form method="post" action="login.php" onsubmit="return validate()">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com" />
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
                                        <a href="" class="link-primary text-decoration-underline">Forgot password</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg on">Log in</button>
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
        let ue = document.getElementById("email");
        let ue_err = document.getElementById("email_err");
        let up = document.getElementById("password");
        let up_err = document.getElementById("password_err");

        function validate() {

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