<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
    <style>
        .rounded-img {
            border-radius: 50%;
            width: 50px;
            height: 100px;
            width: 100px;
        }
    </style>
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
                <form method="post" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="uname" class="form-label">Enter user name</label>
                        <input type="text" class="form-control" id="uname" value="saktiman">
                        <p id="uname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uphone" class="form-label">Enter user phone number</label>
                        <input type="text" class="form-control" id="uphone" value="780632541">
                        <p id="uphone_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uemail" class="form-label">Enter user email</label>
                        <input type="text" class="form-control" id="uemail" value="Sakti123@gmail.com" disabled>
                        <p id="uemail_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="upassword" class="form-label">Enter user password</label>
                        <input type="password" class="form-control" id="upassword" value="hello12345">
                        <input type="checkbox" class="mt-2" onclick="show()"> Show Password
                        <p id="upassword_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment</label>
                        <select id="payment">
                            <option selected value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <p id="upassword_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="uimage" class="form-label">Select user image</label><br>
                        <img src="https://cdn4.sharechat.com/compressed_gm_40_img_122041_165b6fec_1701967119774_sc.jpg?tenant=sc&referrer=tag-service&f=774_sc.jpg" alt="User Image" class="rounded-img"><br>
                        <input type="file" class="mt-2" id="uimage" accept="image/*">
                    </div>
                    <button type="submit" name="add" class="btn btn-primary ">Add User</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        function show() {
            var x = document.getElementById("upassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        var uname = document.getElementById('uname');
        var uphone = document.getElementById('uphone');
        var uemail = document.getElementById('uemail');
        var upassword = document.getElementById('upassword');

        var uname_err = document.getElementById('uname_err');
        var uphone_err = document.getElementById('uphone_err');
        var uemail_err = document.getElementById('uemail_err');
        var upassword_err = document.getElementById('upassword_err');

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

            if (upassword.value === "") {
                upassword_err.style.color = 'red';
                upassword_err.innerHTML = 'Please enter user password';
                upassword.style.border = '1px solid red';
                var upasswordr = false;
            } else {
                var reg_fpas = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                var result = reg_fpas.test(upassword.value);
                if (result == false) {
                    upassword_err.innerHTML = "Please enter the strong password"
                    upassword_err.style.color = "red";
                    upassword.style.border = "1px solid red";
                    upasswordr = false
                } else {
                    upassword_err.innerHTML = "";
                    upassword.style.border = "1px solid #e3e6ea";
                    upasswordr = true;
                }
            }

            return (unamer && uphoner && uemailr && upasswordr);
        }
    </script>
</body>

</html>