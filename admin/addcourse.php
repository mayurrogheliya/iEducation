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
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>
            
            <div class="col-md-9">
                <form method="post" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="cname" class="form-label">Enter course name</label>
                        <input type="text" class="form-control" id="cname">
                        <p id="cname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="cimage" class="form-label">Select course image</label><br>
                        <input type="file" id="cimage" accept="image/*">
                        <p id="cimage_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="cdesc" class="form-label">Enter course description</label>
                        <textarea class="form-control" id="cdesc" rows="3"></textarea>
                        <p id="cdesc_err"></p>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary ">Add Course</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>

    <script>
        var cname = document.getElementById('cname');
        var cimage =document.getElementById('cimage');
        var cdesc = document.getElementById('cdesc');
        var cchpnum = document.getElementById('cchpnum');
        var cchpname = document.getElementById('cchpname');
        var cchpdf = document.getElementById('cchpdf');

        var cname_err = document.getElementById('cname_err');
        var cimage_err = document.getElementById('cimage_err');
        var cdesc_err = document.getElementById('cdesc_err');
        var cchpnum_err = document.getElementById('cchpnum_err');
        var cchpname_err = document.getElementById('cchpname_err');
        var cchpdf_err = document.getElementById('cchpdf_err');

        function check(){
            if (cname.value == ""){
                cname_err.style.color ='red';
                cname_err.innerHTML = 'Please enter course name';
                cname.style.border = '1px solid red';
                var cnamer =  false;
            }else{
                cname_err.innerHTML = "";
                cname.style.border = "1px solid #e3e6ea";
                cnamer = true;
            }

            if (cimage.files.length == 0){
                cimage_err.style.color ='red';
                cimage_err.innerHTML = 'Please select course image';
                cimage.style.border = '1px solid red';
                var cimager =  false;
            }else{
                cimage_err.innerHTML = "";
                cimage.style.border = "1px solid #e3e6ea";
                cimager = true;
            }

            if (cdesc.value == ""){
                cdesc_err.style.color ='red';
                cdesc_err.innerHTML = 'Please enter course description';
                cdesc.style.border = '1px solid red';
                var cdescr =  false;
            }else{
                cdesc_err.innerHTML = "";
                cdesc.style.border = "1px solid #e3e6ea";
                cdescr = true;
            }
            
            
            if (cnamer == true && cimager == true && cdescr == true  ) {
                return true;
            }
            else {
                return false;
            }
        }

    </script>
</body>

</html>