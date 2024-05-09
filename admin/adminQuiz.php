<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
    </style>
</head>

<body>
    <?php
    include_once("navbar.php");
    include_once("../backend/database.php");

    // Query to select all course data
    $q = "SELECT * FROM quizstart";
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
                        <h5 class="card-title">Quiz</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-end ">
                            <a class="btn btn-primary" href="addQuiz.php">Add</a>

                        </div>
                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Total Question</th>
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
                                                <td><?php echo $row['cname']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger my-1" href="deleteQuiz.php?cname=<?php echo $row['cname']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No quiz available</td></tr>";
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