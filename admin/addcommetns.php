<?php
// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['add'])) {
    // Retrieve form data
    $uname = $_POST['uname'];
    $uphone = $_POST['uphone'];
    $uemail = $_POST['uemail'];
    $comment = $_POST['comment'];

    // Insert data into the database
    $q = "INSERT INTO messages(u_name, u_phone, u_email,message) VALUES ('$uname', '$uphone', '$uemail', '$comment')";
    if (mysqli_query($con, $q)) {
        echo "<script>alert('New comments added successfully')</script>";
        header("Location: comments.php");
        exit();
    } else {
        echo "Error: " . $q . "<br>" . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once("navbar.php")
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3 mb-2 bg-light">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <form method="post" action="addcommetns.php" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Enter user name</label>
                        <input type="text" class="form-control" id="uname" name="uname">
                        <p id="uname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uphone" class="form-label">Enter user phone number</label>
                        <input type="text" class="form-control" id="uphone" name="uphone">
                        <p id="uphone_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Enter user email</label>
                        <input type="text" class="form-control" id="uemail" name="uemail">
                        <p id="uemail_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Enter comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <p id="comment_err"></p>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary ">Add Comment</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        var uname = document.getElementById('uname');
        var uphone = document.getElementById('uphone');
        var uemail = document.getElementById('uemail');
        var comment = document.getElementById('comment');

        var uname_err = document.getElementById('uname_err');
        var uphone_err = document.getElementById('uphone_err');
        var uemail_err = document.getElementById('uemail_err');
        var comment_err = document.getElementById('comment_err');

        function check() {
            if (uname.value === "") {
                uname_err.style.color = 'red';
                uname_err.innerHTML = 'Please enter user name';
                uname.style.border = '1px solid red';
                unamer = false;
            } else {
                uname_err.innerHTML = "";
                uname.style.border = "1px solid #e3e6ea";
                unamer = true;
            }

            if (uphone.value === "") {
                uphone_err.style.color = 'red';
                uphone_err.innerHTML = 'Please enter user phone number';
                uphone.style.border = '1px solid red';
                uphoner = false;
            } else {
                var reg_fp = /^[\d]{10}$/;
                var result = reg_fp.test(uphone.value);
                if (result == false) {
                    uphone_err.innerHTML = "Mobile number containe only 10 digist"
                    uphone_err.style.color = "red";
                    uphone.style.border = "1px solid red";
                    uphoner = false
                } else {
                    uphone_err.innerHTML = "";
                    uphone.style.border = "1px solid #e3e6ea";
                    uphoner = true;
                }
            }

            if (uemail.value === "") {
                uemail_err.style.color = 'red';
                uemail_err.innerHTML = 'Please enter user email';
                uemail.style.border = '1px solid red';
                var uemailr = false;
            } else {
                var reg_fe = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/
                var result = reg_fe.test(uemail.value);
                if (result == false) {
                    uemail_err.innerHTML = "Enter email is not proper"
                    uemail_err.style.color = "red";
                    uemail.style.border = "1px solid red";
                    uemailr = false
                } else {
                    uemail_err.innerHTML = "";
                    uemail.style.border = "1px solid #e3e6ea";
                    uemailr = true;
                }
            }

            if (comment.value === "") {
                comment_err.style.color = 'red';
                comment_err.innerHTML = 'Please enter comment';
                comment.style.border = '1px solid red';
                commentr = false;
            } else {
                comment_err.innerHTML = "";
                comment.style.border = "1px solid #e3e6ea";
                commentr = true;
            }

            return (unamer && uphoner && uemailr && commentr);
        }
    </script>
</body>

</html>