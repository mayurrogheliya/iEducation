<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

include_once("../backend/database.php");

// Fetch user data from the database
$aemail = $_SESSION['email'];
$query = "SELECT * FROM admin WHERE a_email = '$aemail'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result || mysqli_num_rows($result) == 0) {
    // Handle error if the query fails or no rows returned
    echo "Error: Unable to fetch user data.";
    echo $aemail;
    exit();
}

// Fetch user data
$userData = mysqli_fetch_assoc($result);
$name = $userData['a_name'];
$email = $userData['a_email'];
$password = $userData['a_password'];
$contact = $userData['a_phone'];
$image = $userData['a_image'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated values from the form
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatedPassword = $_POST['password'];
    $updatedContact = $_POST['contact'];
    $updatedImage = $image; // Default to the existing image

    // Check if a new image file was uploaded
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $newImage = $_FILES['new_image'];
        $newImageName = $newImage['name'];
        $newImageTemp = $newImage['tmp_name'];
        $imageFileType = strtolower(pathinfo($newImageName, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($newImageTemp);
        if ($check !== false) {
            // Generate a unique name for the image
            $updatedImage = uniqid('profile_image_') . '.' . $imageFileType;

            // Move the uploaded file to the desired location
            move_uploaded_file($newImageTemp, "../uploads/" . $updatedImage);
        }
    }

    // Update the user data in the database
    $updateQuery = "UPDATE admin SET a_name='$updatedName', a_phone='$updatedContact', a_image='$updatedImage' WHERE a_email='$aemail'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Redirect to the profile page after successful update
        header("Location: admin_profile.php");
        exit();
    } else {
        // Handle error if the update fails
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar border-bottom shadow-sm shadow-sm navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <span class="h1">iEducation</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary " aria-current="page" href="admin.php">Home</a>
                        <a class="btn btn-primary " aria-current="page" href="changePassword.php">Change Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 col-md-6 mx-auto">
                <div class="profile-section text-start p-4 bg-light rounded">

                    <form id="profileForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="text-center mb-3">
                            <img src="../uploads/<?php echo $image; ?>" alt="User Image" class="profile-image mb-3 rounded-circle img-fluid  shadow" style="width: 150px; height:150px">
                            <input type="file" name="new_image" id="new_image" accept="image/*" style="display: none;">
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-3 col-form-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 col-form-label">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>" disabled>
                                <input type="checkbox" class="mt-2" onclick="show()"> Show Password
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact" class="col-sm-3 col-form-label">Contact:</label>
                            <div class="col-sm-9">
                                <input type="text" id="contact" name="contact" class="form-control" value="<?php echo $contact; ?>" required readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <button type="button" id="editProfileBtn" class="btn btn-primary col-3">Edit Profile</button>
                            <button type="submit" id="saveChangesBtn" class="btn btn-primary col-3 mx-2" style="display:none;">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function show() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        document.getElementById("editProfileBtn").addEventListener("click", function() {
            var inputs = document.querySelectorAll("#profileForm input[readonly]");
            inputs.forEach(function(input) {
                input.removeAttribute("readonly");
            });
            document.getElementById("saveChangesBtn").style.display = "inline-block";
            document.getElementById("new_image").style.display = "block";
        });
        document.getElementById("changeImageButton").addEventListener("click", function() {
            document.getElementById("new_image").click();
        });
    </script>
</body>

</html>