// ******************* contact form validation ****************

function contactvalidate() {
    var fn = document.getElementById("name");
    var fp = document.getElementById("phone");
    var fe = document.getElementById("email");
    var fm = document.getElementById("message");
    
    var frn = document.getElementById("name_err");
    var frp = document.getElementById("phone_err");
    var fre = document.getElementById("email_err");
    var frm = document.getElementById("mess_err");
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
    
    if (fm.value == "") {
        frm.innerHTML = "Please enter the message";
        frm.style.color = "red";
        fm.style.border = "1px solid red";
        var v_fm = false
    } else {
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


// ******************* contact form validation ****************


function loginvalidate() {
    let ue = document.getElementById("email");
    let ue_err = document.getElementById("email_err");
    let up = document.getElementById("password");
    let up_err = document.getElementById("password_err");

    if (ue.value == "") {
        ue_err.innerHTML = "* Please enter the email";
        ue_err.style.color = "red";
        ue.style.border = "1px solid red";
        var uec = false;
    } else {
        let limit_ue = /^[\w._-]+@[\w.]+\.[a-zA-Z]{2,4}$/;
        let result = limit_ue.test(ue.value);
        if (result == false) {
            ue_err.innerHTML = "* Enter email is not proper";
            ue_err.style.color = "red";
            ue.style.border = "1px solid red";
            uec = false;
        } else {
            ue_err.innerHTML = "";
            ue.style.border = "1px solid #e3e6ea";
            uec = true;
        }
    }

    if (up.value == "") {
        up_err.innerHTML = "* Please enter the password";
        up_err.style.color = "red";
        up.style.border = "1px solid red";
        var upc = false;
    } else {
        let limit_up = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        let result = limit_up.test(up.value);
        if (result == false) {
            up_err.innerHTML = "* Please enter the valid password";
            up_err.style.color = "red";
            up.style.border = "1px solid red";
            upc = false;
        } else {
            up.style.border = "1px solid #e3e6ea";
            up_err.innerHTML = ""
            upc = true;
        }
    }

    if (uec == true && upc == true) {
        return true;
    } else {
        return false;
    }
}

// ******************* register form validation ****************


function registervalidate() {
    var ffile = document.getElementById('photo');
    var frfile = document.getElementById('file_err');

    var fn = document.getElementById("name");
    var fp = document.getElementById("phone");
    var fe = document.getElementById("email");
    var fpas = document.getElementById("password");
    var fcpas = document.getElementById("cpassword");

    var frn = document.getElementById("name_err");
    var frp = document.getElementById("phone_err");
    var fre = document.getElementById("email_err");
    var frpas = document.getElementById("password_err");
    var frcpas = document.getElementById("cpassword_err");

    var completion = document.getElementById("completion");
    if (ffile.value == "") {
        frfile.innerHTML = "Please upload the file";
        frfile.style.color = "red";
        ffile.style.border = "1px solid red";
        var v_ff = false
    } else {
        frfile.innerHTML = "";
        frfile.style.color = "";
        ffile.style.border = "";
        var v_ff = true
    }

    if (fn.value == "") {
        frn.innerHTML = "Please enter the name";
        frn.style.color = "red";
        fn.style.border = "1px solid red";
        var v_fn = false
    } else {
        var reg_fn = /^[a-zA-Z ]{2,30}$/;
        var result = reg_fn.test(fn.value);
        if (result == false) {
            frn.innerHTML = "Name contains only letters and minimum length is 2 characters and maximum length is 30 character"
            frn.style.color = "red";
            fn.style.border = "1px solid red";
            v_fn = false
        } else {
            frn.innerHTML = "";
            fn.style.border = "1px solid #e3e6ea";
            v_fn = true;
        }
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

    if (fpas.value == "") {
        frpas.innerHTML = "Please enter the password";
        frpas.style.color = "red";
        fpas.style.border = "1px solid red";
        var v_fpas = false
    } else {
        var reg_fpas = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
        var result = reg_fpas.test(fpas.value);
        if (result == false) {
            frpas.innerHTML = "Please enter the strong password"
            frpas.style.color = "red";
            fpas.style.border = "1px solid red";
            v_fpas = false
        } else {
            frpas.innerHTML = "";
            fpas.style.border = "1px solid #e3e6ea";
            v_fpas = true;
        }
    }

    if (fcpas.value != fpas.value || fcpas.value == "") {
        frcpas.innerHTML = "Password is not match"
        frcpas.style.color = "red";
        fcpas.style.border = "1px solid red";
        var v_fcpas = false
    } else {
        frcpas.innerHTML = "";
        fcpas.style.border = "1px solid #e3e6ea";
        v_fcpas = true;
    }

    if (v_fn == true && v_ff == true && v_fp == true && v_fe == true && v_fpas == true && v_fcpas == true && v_ff == true) {
        return true
        completion.style.display = "block";
    } else {
        return false
    }
}