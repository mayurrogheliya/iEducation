<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Error</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .error-heading {
            color: #dc3545;
        }

        .error-message {
            color: #6c757d;
        }

        .btn-home {
            background-color: #007bff;
            color: #ffffff;
        }

        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div>
            <h4 class="error-heading">Payment Error!</h4>
            <p class="error-message">There was an issue processing your payment. Please try again later.</p>
            <img src="img/payment_failed.gif" alt="Payment Not Successful" class="img-fluid mt-3">
            <a href="index.php" class="btn btn-home mt-3">Back to Home</a>
        </div>
    </div>
</body>

</html>