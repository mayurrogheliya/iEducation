<?php
// Include the database connection file
session_start();
if (!isset($_SESSION['uemail'])) {
    header("location: login.php");
    exit(); // Stop further execution if user is not logged in
}

include_once("header.php");
include_once("./backend/database.php");
$cname = $_GET['cname'] ?? '';

// Check if the user has made the payment
$email = $_SESSION['uemail'];
$query1 = "SELECT payment FROM register WHERE u_email = '$email'";
$result2 = mysqli_query($con, $query1);
$row2 = mysqli_fetch_assoc($result2);
$paymentStatus = $row2['payment'];

$query = "SELECT * FROM chapters WHERE c_name = '$cname'";
$result = mysqli_query($con, $query);

// Check if there are any chapters
if (mysqli_num_rows($result) > 0) {
    // Initialize an array to store chapter data
    $chapters = array();

    // Fetch and store chapter data in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $chapters[] = $row;
    }
} else {
    echo "No chapters found.";
    exit(); // Stop further execution if no chapters found
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iEducation - HTML</title>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <?php
            if ($paymentStatus === 'Yes') {
                echo '<a href="quize.php?cname=' . $cname . '" class="btn btn-primary mb-4 ">Quiz</a>';
            } else {
                echo '<a href="payment.php?cname=' . $cname . '&uemail=' . $email . ' " class="btn btn-primary mb-4 ">Pay Now</a>';
            }
            ?>
        </div>
        <?php foreach ($chapters as $chapter) : ?>
            <div class="card">
                <div class="card-header">
                    <?php echo htmlspecialchars($chapter['chapter_name']); ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($chapter['chapter_name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($chapter['chapter_description']); ?></p>
                    <?php if (!empty($chapter['chapter_pdf'])) : ?>
                        <!-- Directly link to the file's URL without specifying the download attribute -->
                        <a href="uploads/<?php echo htmlspecialchars($chapter['chapter_pdf']); ?>" target="_blank" class="btn btn-primary">Read Chapter</a>
                    <?php else : ?>
                        <p>No PDF available</p>
                    <?php endif; ?>
                    <!-- Add more actions/buttons if needed -->
                </div>
                <div class="card-footer text-muted">
                    Posted on <?php echo htmlspecialchars($chapter['p_time']); ?>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>

</body>

</html>