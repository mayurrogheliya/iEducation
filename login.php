<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 px-xl-5">
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4">Login</p>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign in to your account</h2>
                            <form method="post" action="login.php" onsubmit="return loginvalidate()">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com" />
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        <p id="email_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating ">
                                            <input type="text" class="form-control" name="password" id="password" placeholder="Password" />
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                        <p id="password_err"></p>
                                    </div>
                                    <div class="col-12">
                                        <a href="" class="link-primary text-decoration-underline">Forgot password</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg on">Log in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Don't have an account?
                                            <a href="register.php" class="link-primary text-decoration-underline ">
                                                Sign up
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="./javascript//validation.js"></script>

</body>

</html>