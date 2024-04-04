<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEducation</title>
    <link rel="stylesheet" href="css/universe.css">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="navsection ">
        <nav class="navbar navbar-expand-lg border-bottom shadow-sm shadow-sm">
            <div class="container">
                <a class="nav-link" href="home.php">
                    <h1 class="text-dark">iEduction</h1>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
                    <ul class="navbar-nav ms-4">
                        <li class="nav-item fs-4">
                            <a class="nav-link home" href="home.php">Home</a>
                        </li>
                        <li class="nav-item fs-4 mycolor">
                            <a class="nav-link course" href="course.php">Course</a>
                        </li>
                        <li class="nav-item fs-4">
                            <a class="nav-link about" href="about.php">About</a>
                        </li>
                        <li class="nav-item fs-4">
                            <a class="nav-link contact" href="contact.php">Contact</a>
                        </li>

                        <!-- Conditionally show login/register or logout -->
                        <?php if (!isset($_SESSION['email'])) : ?>
                            <li class="nav-item fs-4">
                                <a class="nav-link login" href="login.php">Login</a>
                            </li>
                            <li class="nav-item fs-4">
                                <a class="nav-link register" href="register.php">Register</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item fs-4">
                                <a class="nav-link logout" href="logout.php">Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- User Profile Section -->
                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
                    <button type="button" class="btn" style="border:none;">
                        <img src="img/notification.png" class="w-50 h-50" alt="notification">
                    </button>

                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle justify-content-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100px;">
                            <img src="img/profile-user.png" alt="profile" class="rounded-circle w-50 h-50 ">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-sm-start " aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php" style="display: <?php echo isset($_SESSION['email']) ? 'block' : 'none'; ?>">Your Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php" style="display: <?php echo isset($_SESSION['email']) ? 'block' : 'none'; ?>">Sign out</a></li>
                            <li><a class="dropdown-item" href="login.php" style="display: <?php echo isset($_SESSION['email']) ? 'none' : 'block'; ?>">Login</a></li>
                            <li><a class="dropdown-item" href="register.php" style="display: <?php echo isset($_SESSION['email']) ? 'none' : 'block'; ?>">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    </div>

    <script src="javascript/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>