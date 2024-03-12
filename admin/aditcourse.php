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
            <div class="col-md-3 ">
                <?php
                include_once("header.php")
                ?>
            </div>
            
            <div class="col-md-9">
                <form method="post" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="cname" class="form-label">Enter course name</label>
                        <input type="text" class="form-control" id="cname" value="HTML5">
                        <p id="cname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="cimage" class="form-label">Select course image</label><br>
                        <img src="../img/HTML5.png" alt="User Image" style="min-width: 80px; max-width: 80px; min-height: 80px; max-height: 80px;"><br>
                        <input type="file" class="mt-2" id="cimage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="cdesc" class="form-label">Enter course description</label>
                        <textarea class="form-control" id="cdesc" rows="3">HTML5 is a markup language used for structuring and presenting content on the World Wide Web. It is the fifth and final major HTML version that is a World Wide Web Consortium recommendation. The current specification is known as the HTML Living Standard</textarea>
                        <p id="cdesc_err"></p>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="cchpnum" class="form-label">Number of chapter</label>
                        <input type="number" class="form-control" id="cchpnum">
                        <p id="cchpnum_err"></p>
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary mb-2 ">Upload chapter</button><br> -->
                    <?php
                    if (isset($_POST["submit"])) {
                        $num = $_POST['cchpnum'];
                        echo '<form method="post onsubmit="chpdetail()">';
                        for ($i = 0; $i < $num; $i++) {
                            echo '
                <div class="mb-3">
                        <label for="cchpname" class="form-label">Enter chapter name</label>
                        <input type="text" class="form-control" id="cchpname">
                        <p id="cchpname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="cchpdf" class="form-label">Select chapter pdf</label><br>
                        <input type="file" id="cchpdf" accept=".pdf,.doc,.docx">
                        <p id="cchpdf_err"></p>
                    </div>';
                        }
                        echo '</form>';
                    }
                    if (isset($_POST['sort'])) {
                        $values = $_POST['num'];
                        sort($values);
                        echo '<h3 class="mt-3">Sorted Values:</h3>';
                        foreach ($values as $value) {
                            echo $value . '<br>';
                        }
                    }
                    ?>
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
        var cdesc = document.getElementById('cdesc');
        var cchpnum = document.getElementById('cchpnum');
        var cchpname = document.getElementById('cchpname');
        var cchpdf = document.getElementById('cchpdf');

        var cname_err = document.getElementById('cname_err');
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
            
            
            
            function chpdetail(){
                if (cchpnum.value == ""){
                    cchpnum_err.style.color ='red';
                    cchpnum_err.innerHTML = 'Please enter how many chapter you upload in this course';
                    cchpnum.style.border = '1px solid red';
                    var cchpnumr =  false;
                }else{
                    cchpnum_err.innerHTML = "";
                cchpnum.style.border = "1px solid #e3e6ea";
                    cchpnumr = true;
                }
                
                if (cchpname.value == ""){
                    cchpname_err.style.color ='red';
                    cchpname_err.innerHTML = 'Please enter chapter name';
                    cchpname.style.border = '1px solid red';
                    var cchpnamer =  false;
                }else{
                    cchpname_err.innerHTML = "";
                cchpname.style.border = "1px solid #e3e6ea";
                    cchpnamer = true;
                }
                
                if (cchpdf.files.length == 0){
                    cchpdf_err.style.color ='red';
                    cchpdf_err.innerHTML = 'Please enter chapter name';
                    cchpdf.style.border = '1px solid red';
                    var cchpdfr =  false;
                }else{
                    cchpdf_err.innerHTML = "";
                cchpdf.style.border = "1px solid #e3e6ea";
                    cchpdfr = true;
                }
            }

            if (cnamer == true && cimager == true && cdescr == true  && cchpnumr == true && cchpnamer == true && cchpdfr == true) {
                return true;
            }
            else {
                return false;
            }
        }

    </script>
</body>

</html>