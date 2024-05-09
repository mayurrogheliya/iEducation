<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

include_once("../backend/database.php");

$error = '';
$errors = '';

if (isset($_POST['change_password_btn'])) {
    $email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Fetch user data from the database
    $check_query = "SELECT * FROM admin WHERE a_email='$email'";
    $result = mysqli_query($con, $check_query);

    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['a_password'];

        // Verify the current password
        if ($current_password == $stored_password) {
            // Update the password in the database
            $update_query = "UPDATE admin SET a_password='$new_password' WHERE a_email='$email'";
            if (mysqli_query($con, $update_query)) {
                $errors = 'Password changed successfully.';
            } else {
                $error = 'Error changing password.';
            }
        } else {
            $error = 'Incorrect current password.';
        }
    } else {
        $error = mysqli_error($con);
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

    <nav class="navbar border-bottom shadow-sm shadow-sm navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <span class="h1">iEducation</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" aria-current="page" href="admin.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 px-xl-5">
                            <p class="text-center h3 fw-bold mb-4 mx-1 mx-md-4">Change Password</p>
                            <p style="color: red; font-weight: bold;"><?php echo $error ?></p>
                            <p style="color: green; font-weight: bold;"><?php echo $errors ?></p>
                            <form action="changePassword.php" class="mx-1 mx-md-4" method="post" onsubmit="return check()">



                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input name='current_password' id='current_password' type="password" class="form-control" style="font-size: 18px;" placeholder="Enter current password" />
                                            <label for="current_password" class="form-label">Current Password</label>
                                        </div>
                                        <p id="c_err"></p>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input name='new_password' id='new_password' type="password" class="form-control" style="font-size: 18px;" placeholder="Enter new password" />
                                            <label for="new_password" class="form-label">New Password</label>
                                        </div>
                                        <p id="n_err"></p>
                                    </div>


                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg" name="change_password_btn">Change Password</button>
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
        var c_pass = document.getElementById("current_password");
        var n_pass = document.getElementById("new_password");
        var c_err = document.getElementById("c_err");
        var n_err = document.getElementById("n_err");

        function check() {
            if (c_pass.value == '') {
                c_err.innerHTML = "* Please enter the current password";
                c_err.style.color = "red";
                var cr = false;
            } else {
                c_err.innerHTML = "";
                cr = true;
            }
            if (n_pass.value == '') {
                n_err.innerHTML = "* Please enter the new password";
                n_err.style.color = "red";
                var nr = false;
            } else {
                n_err.innerHTML = "";
                nr = true;
            }

            if (cr == true && nr == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>