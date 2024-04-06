<?php
// Start the session

session_start();
if (!isset($_SESSION['email'])) {
    include_once("header.php");
}

include_once("./backend/database.php");

$error = '';
if (isset($_POST['btn'])) {
    $pwd = $_POST['pswd'];

    $email = $_SESSION['forgot_email'];
    $token = $_SESSION['forgot_token'];

    $q = "update register set u_password='$pwd' where u_email='$email'";
    if (mysqli_query($con, $q)) {
        $del = "delete from token where email='$email' and token='$token'";
        if (mysqli_query($con, $del)) {
            unset($_SESSION['forgot_email']);
            unset($_SESSION['forgot_token']);
        }
        $error = "Password updated successfully";
?>
        <script>
            window.location.href = "login.php";
        </script>
    <?php
    } else {
        $error = "error in updating password";
    ?>
        <script>
            window.location.href = "login.php";
        </script>
<?php
    }
}
?>
<br>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include_once("header.php");
    ?>

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
                                            <input type="password" class="form-control" id="repwd" name="repswd" placeholder="Repeat Password">
                                            <label for="repwd" class="form-label">Repeat Password</label>
                                            <span id="repswd_err"></span>
                                        </div>
                                    </div>
                                    <p><?php echo $error ?></p>
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
        var newPassword = document.getElementById("pwd");
        var repeatPassword = document.getElementById("repwd");

        var err_np = document.getElementById("pswd_err");
        var err_rp = document.getElementById("repswd_err");

        function validateForm() {

            // Check if new password and repeat password fields are empty
            if (newPassword.value == "") {
                err_np.innerHTML = "New password cannot be empty";
                err_np.style.color = "red";
                var np = false;
            } else {
                err_np.innerHTML = "";
                np = true;
            }
            if (repeatPassword.value == "") {
                err_rp.innerHTML = "Repeat password cannot be empty";
                err_rp.style.color = "red";
                var rp = false;
            } else {
                err_rp.innerHTML = "";
                rp = true;
            }

            // Check if repeat password matches new password
            if (newPassword != repeatPassword) {
                err_rp.innerHTML = "Repeat password does not match the new password";
                var fp = false;
            } else {
                err_rp.innerHTML = "";
                fp = true;
            }

            if (np == true && rp == true && fp == true) {
                return true;
            } else {
                return false;
            }
    </script>
</body>

</html>