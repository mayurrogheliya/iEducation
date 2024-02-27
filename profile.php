<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEducation - User Profile</title>
</head>

<body>
        <?php
            include_once("header.php");
        ?>
        <section class="py-5 py-md-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-6">
                            <div class="card border border-light-subtle rounded-3 shadow-sm">
                                <div class="card-body p-3 p-md-4 p-xl-4">
                                    <div class="about-content">
                                        <form method="GET" >
                                            <div class="text-center mt-2">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLe5PABjXc17cjIMOibECLM7ppDwMmiDg6Dw&usqp=CAU"
                                                    alt="User Img" style="width: 200px; height:200px; border-radius:50%;" />
                                                <input type="file" class="my-3" name="uphoto" id="uphoto">
                                            </div>
                                            <!-- <h2 class="text-center p-2">Mayur Rogheliya</h2> -->
                                            
                                                <button class="btn btn-primary edit-btn mt-1">Save</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

</body>

</html>