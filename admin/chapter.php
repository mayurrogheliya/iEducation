<?php
// Retrieve the chapter value from URL parameter
if (isset($_GET['chapter'])) {
    $chapter = $_GET['chapter'];
} else {
    // Handle case when chapter parameter is not provided
    // You can set a default value or display an error message
    $chapter = "Default Chapter";
}

// Retrieve the cname value from URL parameter
if (isset($_GET['cname'])) {
    $cname = $_GET['cname'];
} else {
    // Handle case when cname parameter is not provided
    // You can set a default value or display an error message
    $cname = "Default cname";
}

// Include the database connection file
include_once("../backend/database.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data for chapters
    $chapterData = array();
    $chapterCount = count($_POST['point']); // Count the number of chapters submitted

    // Loop through the submitted chapters
    for ($i = 0; $i < $chapterCount; $i++) {
        // Check if chapter name and description are set
        if (isset($_POST['point'][$i]) && isset($_POST['description'][$i])) {
            $chapterName = $_POST['point'][$i];
            $chapterDescription = $_POST['description'][$i];
            $chapterData[] = array('name' => $chapterName, 'description' => $chapterDescription);
        }
    }

    // Retrieve form data for uploaded PDFs
    $uploadedPDFs = array();
    foreach ($_FILES['cpdf']['tmp_name'] as $key => $tmp_name) {
        $pdfFileName = $_FILES['cpdf']['name'][$key];
        $pdfTmpName = $_FILES['cpdf']['tmp_name'][$key];
        $pdfSize = $_FILES['cpdf']['size'][$key];
        $pdfError = $_FILES['cpdf']['error'][$key];

        // Specify the directory for uploaded PDFs
        $uploadDirectory = "../uploads/";
        // Handle file upload
        if ($pdfError === UPLOAD_ERR_OK) {
            $destination = $uploadDirectory . basename($pdfFileName);
            if (move_uploaded_file($pdfTmpName, $destination)) {
                $uploadedPDFs[] = $pdfFileName; // Store only the file name
            } else {
                echo "Error uploading file $pdfError";
            }
        }
    }

    // Now, you can insert the data into your database
    // Loop through chapter data and insert into database
    foreach ($chapterData as $key => $chapter) {
        $chapterName = $chapter['name'];
        $chapterDescription = $chapter['description'];
        $pdfName = isset($uploadedPDFs[$key]) ? $uploadedPDFs[$key] : '';
        date_default_timezone_set("Asia/Kolkata");
        $s_time = date("Y-m-d G:i:s");
        // Insert data into the database
        // Prepare and bind
        $stmt = $con->prepare("INSERT INTO chapters (chapter_name, chapter_description, chapter_pdf, c_name, p_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $chapterName, $chapterDescription, $pdfName, $cname, $s_time);

        // Execute the query
        if ($stmt->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Redirect to prevent form resubmission
    header("Location: course.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2aec9589fd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once("navbar.php")
    ?>

    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once("header.php")
                ?>
            </div>

            <div class="col-md-9">
                <!-- Display the chapter value -->
                <form id="chapterForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?cname=<?php echo urlencode($cname); ?>" enctype="multipart/form-data">
                    <?php for ($i = 1; $i <= $chapter; $i++) : ?>
                        <div class="mb-3 mt-4">
                            <label for="point<?php echo $i; ?>" class="form-label">Enter chapter <?php echo $i; ?> name</label>
                            <input type="text" class="form-control chapter-name" id="point<?php echo $i; ?>" name="point[]" placeholder="Chapter <?php echo $i; ?> name">
                        </div>
                        <div class="mb-3">
                            <label for="description<?php echo $i; ?>" class="form-label">Enter chapter <?php echo $i; ?> description</label>
                            <textarea class="form-control chapter-description" id="description<?php echo $i; ?>" name="description[]" rows="4" placeholder="Chapter <?php echo $i; ?> description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cpdf" class="form-label">Select chapter pdf</label><br>
                            <input type="file" id="cpdf" name="cpdf[]" accept=".pdf" class="form-control chapter-pdf">
                            <p id="cpdf_err" style="color: red;"></p>
                        </div>
                    <?php endfor; ?>
                    <button type="submit" name="submit" class="btn btn-primary mb-4 mt-2">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        function check() {
            var valid = true;
            var chapterNames = document.querySelectorAll('.chapter-name');
            var chapterDescriptions = document.querySelectorAll('.chapter-description');
            var chapterPdfs = document.querySelectorAll('.chapter-pdf');

            // Check if chapter names are not empty
            chapterNames.forEach(function(chapterName) {
                if (chapterName.value.trim() === '') {
                    valid = false;
                    chapterName.classList.add('is-invalid');
                } else {
                    chapterName.classList.remove('is-invalid');
                }
            });

            // Check if chapter descriptions are not empty
            chapterDescriptions.forEach(function(chapterDescription) {
                if (chapterDescription.value.trim() === '') {
                    valid = false;
                    chapterDescription.classList.add('is-invalid');
                } else {
                    chapterDescription.classList.remove('is-invalid');
                }
            });

            // Check if a chapter PDF is selected for each chapter
            chapterPdfs.forEach(function(chapterPdf) {
                if (chapterPdf.files.length === 0) {
                    valid = false;
                    chapterPdf.classList.add('is-invalid');
                } else {
                    chapterPdf.classList.remove('is-invalid');
                }
            });
            return valid; // Return the validation result
        }

        // Form submission
        document.getElementById('chapterForm').addEventListener('submit', function(event) {
            if (!check()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>

</body>

</html>