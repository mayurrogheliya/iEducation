<?php
require_once "session.php";
?>
<nav class="navbar-expand-lg navbar-light mb-2">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto d-flex flex-column list-group w-100 ">
            <li class="nav-item list-group-item">
                <a class="nav-link" href="admin.php" style="font-size: 20px; ">
                    <i class="fas fa-tachometer-alt" style="padding-right: 10px; font-size: 25px;"></i>Dashboard
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="user.php" style="font-size: 20px;">
                    <i class="fas fa-users" style="padding-right: 10px; font-size: 25px;"></i>Manage Users
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="course.php" style="font-size: 20px;">
                    <i class="fas fa-book" style="padding-right: 10px; font-size: 25px;"></i>Manage Courses
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="comments.php" style="font-size: 20px;">
                    <i class="fas fa-comments" style="padding-right: 10px; font-size: 25px;"></i>Comments
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="about.php" style="font-size: 20px;">
                    <i class="fas fa-headset" style="padding-right: 10px; font-size: 25px;"></i>About
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="review.php" style="font-size: 20px;">
                    <i class="fas fa-star" style="padding-right: 10px; font-size: 25px;"></i>Review
                </a>
            </li>
            <li class="nav-item list-group-item">
                <a class="nav-link" href="adminQuiz.php" style="font-size: 20px;">
                    <i class="fas fa-question-circle" style="padding-right: 10px; font-size: 25px;"></i>Quiz
                </a>
            </li>
        </ul>
    </div>
</nav>