<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include_once("header.php");
    ?>
    <section class="py-5 py-xl-8" id="course">
        <div class="container">
            <div class="row d-flex justify-content-center ">
                <h2 class="text-center ">Featured Courses</h2>
                <div class="col-lg-10 col-xl-10 col-md-10">
                    <p class="fs-5 text-center">"Explore our diverse collection of enriching courses designed to
                        foster
                        knowledge,
                        skills, and personal
                        growth. Unlock
                        your potential with our featured educational content today."</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="img/HTML5.png" class="card-img-top cardimage" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">HTML5</h5>
                            <p class="card-text">HTML5 is a markup language used for structuring and presenting
                                content
                                on the World Wide Web. It is the fifth and final
                                major HTML version that is a World Wide Web Consortium recommendation. The
                                current
                                specification is known as the HTML
                                Living Standard.</p>
                            <a href="chtml.php" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <img src="img/CSS3.png" class="card-img-top cardimage" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">CSS3</h5>
                            <p class="card-text">Cascading Style Sheets (CSS) is a style sheet language used for
                                describing the look and formatting of a document written
                                in a markup language. CSS3 is a latest standard of css earlier versions(CSS2).
                                The
                                main
                                difference between css2 and css3
                                is follows − Media Queries. Namespaces.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="img/java-script.jpg" class="card-img-top cardimage" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">JavaScript</h5>
                            <p class="card-text">JavaScript, often abbreviated as JS, is a programming language
                                and
                                core
                                technology of the World Wide Web, alongside HTML
                                and CSS. As of 2023, 98.7% of websites use JavaScript on the client side for
                                webpage
                                behavior, often incorporating
                                third-party libraries.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>