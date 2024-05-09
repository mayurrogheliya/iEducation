<?php
// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['next1'])) {
    // Retrieve form data
    $cname = $_POST['cname'];
    $total = $_POST['total'];
    $q = "INSERT INTO quizstart(cname,total) VALUES ('$cname','$total')";
    if (mysqli_query($con, $q)) {
        header("Location: question.php?total=" . $total . "&cname=" . $cname);
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
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <form method="post" action="addQuiz.php" onsubmit="return check()">
                    <div class="mb-3">
                        <label for="cname" class="form-label">Enter course name</label>
                        <input type="text" class="form-control" id="cname" name="cname">
                        <p id="cname_err"></p>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Enter the question number</label>
                        <input type="number" class="form-control" id="total" name="total">
                        <p id="total_err"></p>
                    </div>
                    <button type="submit" name="next1" class="btn btn-primary ">Next →</button>
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
        var total = document.getElementById('total');

        var cname_err = document.getElementById('cname_err');
        var total_err = document.getElementById('total_err');

        function check() {
            if (cname.value == "") {
                cname_err.style.color = 'red';
                cname_err.innerHTML = 'Please enter course name';
                cname.style.border = '1px solid red';
                var cnamer = false;
            } else {
                cname_err.innerHTML = "";
                cname.style.border = "1px solid #e3e6ea";
                cnamer = true;
            }

            if (total.value == "") {
                total_err.style.color = 'red';
                total_err.innerHTML = 'Please enter number of questions';
                total.style.border = '1px solid red';
                var totalr = false;
            } else {
                total_err.innerHTML = "";
                total.style.border = "1px solid #e3e6ea";
                totalr = true;
            }


            if (cnamer == true && totalr == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>