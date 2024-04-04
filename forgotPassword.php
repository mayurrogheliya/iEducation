<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/Exception.php');

include_once("./backend/database.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Generate a random OTP
    $otp = mt_rand(100000, 999999);

    // Store the OTP in the session for verification later
    $_SESSION['otp'] = $otp;

    // Send the OTP to the user's email
    $mail = new PHPMailer();
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com';
        $mail->Password = 'your_email_password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'OTP for Password Reset';
        $mail->Body = 'Your OTP for password reset is: ' . $otp;

        if ($mail->send()) {
            $_SESSION['success'] = "An OTP has been sent to your email address.";
        } else {
            $_SESSION['error'] = "Failed to send OTP. Please try again later.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Email sending failed. Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>

<body>
    <h2>Forgot Password</h2>
    <?php if (isset($_SESSION['success'])) : ?>
        <div style="color: green;"><?php echo $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <div style="color: red;"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Enter your email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>