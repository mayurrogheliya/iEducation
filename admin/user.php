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
    include_once("navbar.php")
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3 mb-2 bg-light">
                <?php
                include_once("header.php")
                ?>
            </div>
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-end ">
                            <a class="btn btn-primary" href="adduser.php">Add</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Phone</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="https://cdn4.sharechat.com/compressed_gm_40_img_122041_165b6fec_1701967119774_sc.jpg?tenant=sc&referrer=tag-service&f=774_sc.jpg" alt="User Image" class="rounded-img"></td>
                                    <td>saktiman</td>
                                    <td>Sakti123@gmail.com</td>
                                    <td>hello12345</td>
                                    <td>780632541</td>
                                    <td>Yes</td>
                                    <td>
                                        <a class="btn btn-primary  my-1 " href="adituser.php">Adit</a>
                                        <button class="btn btn-danger my-1 ">Delete</button>
                                    </td>
                                </tr>
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