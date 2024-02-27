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
    <nav class="navbar border-bottom shadow-sm shadow-sm">
        <span class="mb-0 h1">iEducation</span>
        <div>
        <button class="btn btn-primary ">Logout</button>
        <a class="btn btn-primary " href="..">Back to home</a>
        </div>
    </nav>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3 mb-2 bg-light">
                <div class="list-group">
                    <a href="admin.php" id="dashboard"
                        class="bg-light list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                    <a href="user.php"
                        class="bg-light  list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-users"></i>
                        Manage Users
                    </a>
                    <a href="course.php"
                        class="bg-light  list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-book"></i>
                        Manage Courses
                    </a>
                    <a href="comments.php"
                        class="bg-light  list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-comments"></i>
                        Comments
                    </a>
                    <a href="#"
                        class="bg-light  list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-cog"></i>
                        Settings
                    </a>
                    <a href="#"
                        class="bg-light  list-group-item-action py-3 px-2  d-flex  justify-content-start align-items-center "
                        style="font-size: larger;">
                        <i style="padding-right: 10px; font-size: 25px;" class="fas fa-question-circle"></i>
                        Help and
                        Support
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User Comments</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>123-456-7890</td>
                                    <td>Hello, I have a question.</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>janesmith@example.com</td>
                                    <td>987-654-3210</td>
                                    <td>Can you help me with this issue Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque eum voluptas repellat magnam, neque fuga saepe quisquam sapiente ex sequi??</td>
                                </tr>
                                <!-- Add more rows as needed -->
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