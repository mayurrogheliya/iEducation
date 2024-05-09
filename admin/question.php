<?php
// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $questions = $_POST['question'];
    $options1 = $_POST['option1'];
    $options2 = $_POST['option2'];
    $options3 = $_POST['option3'];
    $options4 = $_POST['option4'];
    $answers = $_POST['answer'];
    $cname = $_POST['cname'];

    // Loop through each question
    for ($i = 0; $i < count($questions); $i++) {
        // Retrieve data for each question
        $question = mysqli_real_escape_string($con, $questions[$i]);
        $option1 = mysqli_real_escape_string($con, $options1[$i]);
        $option2 = mysqli_real_escape_string($con, $options2[$i]);
        $option3 = mysqli_real_escape_string($con, $options3[$i]);
        $option4 = mysqli_real_escape_string($con, $options4[$i]);
        $answer = mysqli_real_escape_string($con, $answers[$i]);

        // Insert the question into the database
        $q = "INSERT INTO quiz (cname, que, opt1, opt2, opt3, opt4, ans) 
              VALUES ('$cname', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')";

        if (mysqli_query($con, $q)) {
            // Success message
            header("Location: adminQuiz.php");
            $success_message = "Questions added successfully!";
        } else {
            // Error message
            $error_message = "Error: " . mysqli_error($con);
        }
    }
}

$total = $_GET['total'];
$cname = $_GET['cname'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Questions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Add Questions</h2>
                <?php
                // Display success or error message
                if (isset($success_message)) {
                    echo '<div class="alert alert-success" role="alert">' . $success_message . '</div>';
                }
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                }
                ?>
                <form method="post" action="question.php">
                    <input type="hidden" name="cname" value="<?php echo $cname; ?>">
                    <?php for ($i = 1; $i <= $total; $i++) { ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Question <?php echo $i; ?></h5>
                                <div class="form-group">
                                    <label for="question_<?php echo $i; ?>">Question</label>
                                    <input type="text" class="form-control" id="question_<?php echo $i; ?>" name="question[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="option1_<?php echo $i; ?>">Option 1</label>
                                    <input type="text" class="form-control" id="option1_<?php echo $i; ?>" name="option1[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="option2_<?php echo $i; ?>">Option 2</label>
                                    <input type="text" class="form-control" id="option2_<?php echo $i; ?>" name="option2[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="option3_<?php echo $i; ?>">Option 3</label>
                                    <input type="text" class="form-control" id="option3_<?php echo $i; ?>" name="option3[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="option4_<?php echo $i; ?>">Option 4</label>
                                    <input type="text" class="form-control" id="option4_<?php echo $i; ?>" name="option4[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="answer_<?php echo $i; ?>">Correct Answer</label>
                                    <select class="form-control" id="answer_<?php echo $i; ?>" name="answer[]" required>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>