<?php
include_once("../backend/database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch review data from the database based on the ID
    $query = "SELECT * FROM reviews WHERE id = $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission
            $rating = $_POST['rating'];
            $review = $_POST['review'];
            $update_query = "UPDATE reviews SET rating='$rating', review='$review' WHERE id=$id";
            $update_result = mysqli_query($con, $update_query);
            // Check if update was successful
            if ($update_result) {
                echo "Review updated successfully";
                header("Location: review.php?id=$id"); // Redirect back to the review page
                exit(); // Exit to prevent further execution
            } else {
                echo "Error updating review information: " . mysqli_error($con);
            }
        }
    } else {
        echo "Review not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Review</h2>
        <form method="post">
            <div class="form-group">
                <label for="user_name">User Name:</label>
                <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo $row['user_name']; ?>">
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" class="form-control" id="rating" name="rating" max='5' min='1' value="<?php echo $row['rating']; ?>">
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea class="form-control" id="review" name="review"><?php echo $row['review']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>
</body>

</html>