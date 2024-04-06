<?php

session_start();
if (!isset($_SESSION['email'])) {
    include_once("header.php");
}

// Include the database connection file
include_once("./backend/database.php");
$successMessage = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO messages (u_name, u_email, u_phone, message) VALUES ('$fullname', '$email', '$phone', '$message')";

    if (mysqli_query($con, $sql)) {
        // Success message
        $successMessage = "Message sent successfully!";
        echo "<script>alert('$successMessage');</script>";
        echo "<script>window.location.href = 'contact.php';</script>";
    } else {
        // Error message
        $successMessage = "Error sending message. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <section class="py-5 py-xl-8" id="contact">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9">
                    <div class="bg-white border rounded shadow-sm overflow-hidden">
                        <form onsubmit="return contactvalidate()" method="post">
                            <div class="row gy-4 gy-xl-4 p-4 p-xl-4">
                                <h2>Contact Us</h2>
                                <?php if (!empty($successMessage)) : ?>
                                    <div style="color: green; font-size: larger;">
                                        <?php echo $successMessage; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-12">
                                    <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="fullname" />
                                    <p id="name_err"></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope-o fa-lg"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" />
                                    </div>
                                    <p id="email_err"></p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-phone fa-lg"></i>
                                        </span>
                                        <input type="number" class="form-control" id="phone" name="phone" />
                                    </div>
                                    <p id="phone_err"></p>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                    <p id="mess_err"></p>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="./javascript/validation.js"></script>

</body>

</html>