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
            height: 50px;
        }
    </style>
</head>

<body>
    <?php
    include_once("navbar.php");
    include_once("../backend/database.php");

    // Query to select all course data
    $q = "SELECT * FROM course";
    $result = mysqli_query($con, $q);
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Course Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-end ">
                            <a class="btn btn-primary" href="addcourse.php">Add</a>

                        </div>
                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Course Image</th>
                                        <th>Course Name</th>
                                        <th>Course Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are any results
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through each row of the result
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><img src="../CourseImage/<?php echo $row['c_image']; ?>" alt="User Image" style="min-width: 80px; max-width: 80px; min-height: 80px; max-height: 80px;"></td>
                                                <td><?php echo $row['c_name']; ?></td>
                                                <td><?php echo $row['c_desc']; ?></td>
                                                <td>
                                                    <a class="btn btn-primary  my-1 " href="aditcourse.php?id=<?php echo $row['c_id']; ?>">Edit</a>
                                                    <a class="btn btn-danger my-1" href="deletecourse.php?id=<?php echo $row['c_id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No course found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../javascript/admin.js"></script>
</body>

</html>