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
    include_once("navbar.php");
    include_once("../backend/database.php");
    $q = "SELECT * FROM messages";
    $result = mysqli_query($con, $q);
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php");
                ?>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-end ">
                            <a class="btn btn-primary" href="addcommetns.php">Add</a>

                        </div>
                        <table class="table table-bordered overflow-x-scroll ">
                            <thead>
                                <tr>

                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
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
                                            <td><?php echo $row['u_name']; ?></td>
                                            <td><?php echo $row['u_email']; ?></td>
                                            <td><?php echo $row['u_phone']; ?></td>
                                            <td><?php echo $row['message']; ?></td>
                                            <td>
                                                <a class="btn btn-primary  my-1 " href="aditcomment.php?email=<?php echo $row['u_email']; ?>">Edit</a>
                                                <a class="btn btn-danger my-1" href="deletecomments.php?email=<?php echo $row['u_email']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No comments found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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