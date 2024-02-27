<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
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
                        <form onsubmit="return validate()" method="post">
                            <div class="row gy-4 gy-xl-4 p-4 p-xl-4">
                                <h2>Contact Us</h2>
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

    <script>
        var fn = document.getElementById("name");
        var fp = document.getElementById("phone");
        var fe = document.getElementById("email");
        var fm = document.getElementById("message");

        var frn = document.getElementById("name_err");
        var frp = document.getElementById("phone_err");
        var fre = document.getElementById("email_err");
        var frm = document.getElementById("mess_err");

        function validate() {
            if (fn.value == "") {
                frn.innerHTML = "Please enter the name";
                frn.style.color = "red";
                fn.style.border = "1px solid red";
                var v_fn = false
            } else {
                frn.innerHTML = "";
                fn.style.border = "1px solid #e3e6ea";
                v_fn = true;
            }

            if (fp.value == "") {
                frp.innerHTML = "Please enter the phone number";
                frp.style.color = "red";
                fp.style.border = "1px solid red";
                var v_fp = false
            } else {
                var reg_fp = /^[\d]{10}$/;
                var result = reg_fp.test(fp.value);
                if (result == false) {
                    frp.innerHTML = "Mobile number containe only 10 digist"
                    frp.style.color = "red";
                    fp.style.border = "1px solid red";
                    v_fp = false
                } else {
                    frp.innerHTML = "";
                    fp.style.border = "1px solid #e3e6ea";
                    v_fp = true;
                }
            }

            if (fe.value == "") {
                fre.innerHTML = "Please enter the email";
                fre.style.color = "red";
                fe.style.border = "1px solid red";
                var v_fe = false
            } else {
                var reg_fe = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/
                var result = reg_fe.test(fe.value);
                if (result == false) {
                    fre.innerHTML = "Enter email is not proper"
                    fre.style.color = "red";
                    fe.style.border = "1px solid red";
                    v_fe = false
                } else {
                    fre.innerHTML = "";
                    fe.style.border = "1px solid #e3e6ea";
                    v_fe = true;
                }

            }

            if(fm.value == ""){
                frm.innerHTML = "Please enter the message";
                frm.style.color = "red";
                fm.style.border = "1px solid red";
                var v_fm = false
            }else{
                frm.innerHTML = "";
                fm.style.border = "1px solid #e3e6ea";
                v_fm = true;
            }

            if (v_fn == true && v_fp == true && v_fe == true && v_fm == true) {
                return true
            } else {
                return false
            }
        }
    </script>

</body>

</html>