<?php
include_once("./backend/database.php");
session_start();
if (!isset($_SESSION['uemail'])) {
    header("location: login.php");
    exit(); // Stop further execution if user is not logged in
}
$cname = $_GET['cname'];

if (isset($_GET['cname'])) {
    $cname = mysqli_real_escape_string($con, $_GET['cname']);
    // Check if $cname exists in the quiz table
    $check_query = "SELECT * FROM quiz WHERE cname = '$cname'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) == 0) {
        echo "
    <div class='container mt-5'>
        <div class='alert alert-danger text-center'>
            <h4 class='alert-heading'>Error</h4>
            <p class='mb-0'>Quiz '$cname' does not exist.</p>
        </div>
        <div class='text-center'>
            <a href='htmlchapter.php?cname=$cname' class='btn btn-primary'>Go Back</a>
        </div>
    </div>
    ";
        exit(); // Stop execution if cname doesn't exist in the quiz table
    }
} else {
    echo "Error: cname parameter is missing.";
    exit(); // Stop execution if cname parameter is missing
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;

    // Fetch questions from the database
    $sql = "SELECT * FROM quiz WHERE cname = '$cname'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $question_number = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the submitted answer matches the correct answer
            if ($_POST['answer'][$question_number] == $row['ans']) {
                $score++;
            }
            $question_number++;
        }
    }

    // Display the result
    echo "<h2 class='text-center pt-3 '>Your Score: $score</h2>";
?><div class="d-flex justify-content-center"><?php
                                                // Option to play again
                                                echo '<a href="quize.php?cname=' . $cname . ' " class="btn btn-primary">Play Again</a>';
                                            }
                                                ?>
    </div>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mb-4">
            <div class="d-flex justify-content-between align-items-center  mt-4 ">
                <h1> <?php echo $cname ?> Quiz</h1>
                <div>
                    <a href="htmlchapter.php?cname=<?php echo $cname ?>" class="btn btn-primary">Exit</a>
                </div>
            </div>
            <form method="post">
                <?php
                // Fetch questions from the database
                $sql = "SELECT * FROM quiz WHERE cname = '$cname'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $question_number = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Question <?php echo $question_number; ?></h5>
                                <p><?php echo $row['que']; ?></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?php echo $question_number; ?>]" id="option1_<?php echo $question_number; ?>" value="1" required>
                                    <label class="form-check-label" for="option1_<?php echo $question_number; ?>"><?php echo $row['opt1']; ?></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?php echo $question_number; ?>]" id="option2_<?php echo $question_number; ?>" value="2" required>
                                    <label class="form-check-label" for="option2_<?php echo $question_number; ?>"><?php echo $row['opt2']; ?></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?php echo $question_number; ?>]" id="option3_<?php echo $question_number; ?>" value="3" required>
                                    <label class="form-check-label" for="option3_<?php echo $question_number; ?>"><?php echo $row['opt3']; ?></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[<?php echo $question_number; ?>]" id="option4_<?php echo $question_number; ?>" value="4" required>
                                    <label class="form-check-label" for="option4_<?php echo $question_number; ?>"><?php echo $row['opt4']; ?></label>
                                </div>
                            </div>
                        </div>
                <?php
                        $question_number++;
                    }
                } else {
                    echo "No questions available.";
                }
                ?>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </body>

    </html>