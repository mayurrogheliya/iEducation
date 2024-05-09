<?php
// Include the database connection file
session_start();
if (!isset($_SESSION['uemail'])) {
    header("location: login.php");
}

include_once("header.php");
include_once("./backend/database.php");
$cname = $_GET['cname'];
$useremail = $_GET['uemail'];

?>


<!DOCTYPE html>
<html>

<head>
    <title>How to Integrate Razorpay payment gateway in PHP | tutorialswebsite.com</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body style="background-repeat: no-repeat; background-color: #f8f9fa;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title m-0">Pay and Take a Quiz</h5>
                    </div>
                    <div class="card-body">
                        <form id="paymentForm">
                            <div class="form-group ">
                                <label for="billing_name">Name</label>
                                <input type="text" class="form-control" id="billing_name" name="name" placeholder="Enter your name" required>
                            </div>

                            <div class="form-group my-3 ">
                                <label for="billing_mobile">Mobile Number</label>
                                <input type="tel" class="form-control" id="billing_mobile" name="phone" placeholder="Enter your mobile number" required>
                            </div>
                            <div class="form-group my-3 ">
                                <label for="payAmount">Payment Amount (INR)</label>
                                <input type="number" class="form-control" id="payAmount" name="amount" value="500" min="500" max="500" placeholder="Enter amount" readonly required>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" name="btn" id="PayNow">Submit & Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //Pay Amount
        jQuery(document).ready(function($) {

            jQuery('#PayNow').click(function(e) {

                var paymentOption = '';
                let billing_name = $('#billing_name').val();
                let billing_mobile = $('#billing_mobile').val();
                var shipping_name = $('#billing_name').val();
                var shipping_mobile = $('#billing_mobile').val();
                let billing_email = '<?php echo $useremail; ?>';
                var shipping_email = '<?php echo $useremail; ?>';

                // Check if any of the input fields are empty
                if (billing_name === '' || billing_mobile === '' || billing_email === '') {
                    // Display error message
                    alert('Please fill in all the fields');
                    return;
                }

                var paymentOption = "netbanking";
                var payAmount = $('#payAmount').val();

                var request_url = "submitpayment.php";
                var formData = {
                    billing_name: billing_name,
                    billing_mobile: billing_mobile,
                    billing_email: billing_email,
                    shipping_name: shipping_name,
                    shipping_mobile: shipping_mobile,
                    shipping_email: shipping_email,
                    paymentOption: paymentOption,
                    payAmount: payAmount,
                    action: 'payOrder'
                }

                $.ajax({
                    type: 'POST',
                    url: request_url,
                    data: formData,
                    dataType: 'json',
                    encode: true,
                }).done(function(data) {

                    if (data.res == 'success') {
                        var orderID = data.order_number;
                        var orderNumber = data.order_number;
                        var options = {
                            "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                            "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": "iEducation", //your business name
                            "description": "Payment for quiz and get the certificate of the course",
                            "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfOI5aZGUj7AQR-oKwK5YxmlGMEJsGsEQXjSr8Pel7AQ&s",
                            "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                            "handler": function(response) {
                                window.location.replace("payment-success.php?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature + "&uemail=<?php echo $useremail; ?>" + "&cname=<?php echo $cname; ?>");
                            },
                            "modal": {
                                "ondismiss": function() {
                                    window.location.replace("payment-success.php?oid=" + orderID);
                                }
                            },
                            "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                                "name": data.userData.name, //your customer's name
                                "email": data.userData.email,
                                "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                            },
                            "notes": {
                                "address": "iEducation"
                            },
                            "config": {
                                "display": {
                                    "blocks": {
                                        "banks": {
                                            "name": 'Pay using ' + paymentOption,
                                            "instruments": [

                                                {
                                                    "method": paymentOption
                                                },
                                            ],
                                        },
                                    },
                                    "sequence": ['block.banks'],
                                    "preferences": {
                                        "show_default_blocks": true,
                                    },
                                },
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function(response) {

                            window.location.replace("payment-failed.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);

                        });

                        rzp1.open();
                        e.preventDefault();
                    }

                });
            });
        });
    </script>


</body>

</html>