<?php
session_start();
include_once("./backend/database.php");

$update_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (empty($current_password)) {
        $update_password_err = "Please enter your current password.";
    } else {
        // Retrieve the user's current password from the database
        $query = "SELECT u_password FROM register WHERE u_email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['u_password'];

            // Verify if the entered current password matches the stored password
            if ($current_password == $stored_password) {
                // Update the password in the database
                $updateQuery = "UPDATE register SET u_password = '$new_password' WHERE u_email = '$email'";
                $updateResult = mysqli_query($con, $updateQuery);

                if ($updateResult) {
                    // Password updated successfully
                    echo "Password updated successfully.";
                } else {
                    // Error updating password
                    $update_password_err = "Error updating password. Please try again later.";
                }
            } else {
                // Incorrect current password
                $update_password_err = "Incorrect current password.";
            }
        } else {
            // Error retrieving user data from the database
            $update_password_err = "Error retrieving user data. Please try again later.";
        }
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
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4">Change Password</p>
                            <div class="col-12">
                                <p style="color: red; font-weight: bold;"><?php echo $update_password_err; ?></p>
                            </div>
                            <form id="changePasswordForm" method="post" action="changePassword.php" onsubmit="return changePasswordValidate()">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" />
                                            <label for="current_password" class="form-label">Current Password</label>
                                        </div>
                                        <p id="currentPasswordError" style="color: red; font-weight: bold;"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" />
                                            <label for="new_password" class="form-label">New Password</label>
                                        </div>
                                        <p id="newPasswordError" style="color: red; font-weight: bold;"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="button" name="submit" class="btn btn-primary btn-lg on" onclick="submitForm()">Change Password</button>
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
        function submitForm() {
            var currentPassword = document.getElementById("current_password").value;
            var newPassword = document.getElementById("new_password").value;

            var currentPasswordError = document.getElementById("currentPasswordError");
            var newPasswordError = document.getElementById("newPasswordError");

            if (currentPassword === "") {
                currentPasswordError.innerText = "Please enter your current password.";
            } else {
                currentPasswordError.innerText = "";
            }

            if (newPassword === "") {
                newPasswordError.innerText = "Please enter a new password.";
            } else {
                newPasswordError.innerText = "";
            }
        }
    </script>
</body>

</html>