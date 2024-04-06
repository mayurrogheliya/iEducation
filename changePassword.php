<?php
session_start();
include_once("./backend/database.php");

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

if (isset($_POST['change_password_btn'])) {
    $email = $_SESSION['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $check_query = "SELECT * FROM register WHERE u_email='$email'";
    $result = mysqli_query($con, $check_query);
    if ($row = mysqli_fetch_assoc($result)) {
        $hashed_password = $row['u_password'];
        if (password_verify($current_password, $hashed_password)) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE register SET u_password='$new_hashed_password' WHERE u_email='$email'";
            if (mysqli_query($con, $update_query)) {
                echo "<script>alert('Password changed successfully.')</script>";
            } else {
                echo "<script>alert('Error changing password.')</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password.')</script>";
        }
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
                                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-3">Change Password</p>
                                <form action="changePassword.php" class="mx-1 mx-md-4" method="post">

                                    <div class="form-outline mb-4">
                                        <input name='current_password' type="password" class="form-control" style="font-size: 18px;" placeholder="Enter current password" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input name='new_password' type="password" class="form-control" style="font-size: 18px;" placeholder="Enter new password" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input name='confirm_new_password' type="password" class="form-control" style="font-size: 18px;" placeholder="Confirm new password" />
                                    </div>

                                    <div class="d-flex justify-content-start mb-2 mb-lg-2">
                                        <button type="submit" class="btn btn-primary btn-lg" name="change_password_btn">Change Password</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>