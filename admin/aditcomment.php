<?php
include_once("../backend/database.php");

// Check if email parameter is provemailed in the URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch messages data from the database based on the provemailed email
    $query = "SELECT * FROM messages WHERE u_email = '$email'";
    $result = mysqli_query($con, $query);

    // Check if messages exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted
        if (isset($_POST['update'])) {
            // Retrieve updated form data
            $uname = $_POST['uname'];
            $uemail = $_POST['uemail'];
            $uphone = $_POST['uphone'];
            $comment = $_POST['comment'];

            $update_query = "UPDATE messages SET u_name='$uname', u_phone='$uphone', message='$comment' WHERE u_email='$email'";

            $update_result = mysqli_query($con, $update_query);

            // Check if update was successful
            if ($update_result) {
                echo "messages information updated successfully";
                // Redirect to messages.php or any other page
                header("Location: comments.php");
                exit();
            } else {
                echo "Error updating messages information: " . mysqli_error($con);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wemailth=device-wemailth, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once("navbar.php")
    ?>

    <div class="container-fluemail mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <form method="post" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Enter user name</label>
                        <input type="text" class="form-control" email="uname" name="uname" value="<?php echo $row['u_name']; ?>">
                        <p email="uname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uphone" class="form-label">Enter user phone number</label>
                        <input type="text" class="form-control" email="uphone" name="uphone" value="<?php echo $row['u_phone']; ?>">
                        <p email="uphone_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Enter user email</label>
                        <input type="text" class="form-control" email="uemail" name="uemail" disabled value="<?php echo $row['u_email']; ?>">
                        <p email="uemail_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Enter comment</label>
                        <textarea class="form-control" email="comment" name="comment" rows="3"><?php echo $row['message']; ?></textarea>
                        <p email="comment_err"></p>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary ">Edit Comment</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        var uname = document.getElementByemail('uname');
        var uphone = document.getElementByemail('uphone');
        var uemail = document.getElementByemail('uemail');
        var comment = document.getElementByemail('comment');

        var uname_err = document.getElementByemail('uname_err');
        var uphone_err = document.getElementByemail('uphone_err');
        var uemail_err = document.getElementByemail('uemail_err');
        var comment_err = document.getElementByemail('comment_err');

        function check() {
            if (uname.value === "") {
                uname_err.style.color = 'red';
                uname_err.innerHTML = 'Please enter user name';
                uname.style.border = '1px solemail red';
                unamer = false;
            } else {
                uname_err.innerHTML = "";
                uname.style.border = "1px solemail #e3e6ea";
                unamer = true;
            }

            if (uphone.value === "") {
                uphone_err.style.color = 'red';
                uphone_err.innerHTML = 'Please enter user phone number';
                uphone.style.border = '1px solemail red';
                uphoner = false;
            } else {
                var reg_fp = /^[\d]{10}$/;
                var result = reg_fp.test(uphone.value);
                if (result == false) {
                    uphone_err.innerHTML = "Mobile number containe only 10 digist"
                    uphone_err.style.color = "red";
                    uphone.style.border = "1px solemail red";
                    uphoner = false
                } else {
                    uphone_err.innerHTML = "";
                    uphone.style.border = "1px solemail #e3e6ea";
                    uphoner = true;
                }
            }

            if (uemail.value === "") {
                uemail_err.style.color = 'red';
                uemail_err.innerHTML = 'Please enter user email';
                uemail.style.border = '1px solemail red';
                var uemailr = false;
            } else {
                var reg_fe = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/
                var result = reg_fe.test(uemail.value);
                if (result == false) {
                    uemail_err.innerHTML = "Enter email is not proper"
                    uemail_err.style.color = "red";
                    uemail.style.border = "1px solemail red";
                    uemailr = false
                } else {
                    uemail_err.innerHTML = "";
                    uemail.style.border = "1px solemail #e3e6ea";
                    uemailr = true;
                }
            }

            if (comment.value === "") {
                comment_err.style.color = 'red';
                comment_err.innerHTML = 'Please enter comment';
                comment.style.border = '1px solemail red';
                commentr = false;
            } else {
                comment_err.innerHTML = "";
                comment.style.border = "1px solemail #e3e6ea";
                commentr = true;
            }

            return (unamer && uphoner && uemailr && commentr);
        }
    </script>
</body>

</html>