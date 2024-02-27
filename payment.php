<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<section class="credit-card mt-5 ">
        <div class="container">

            <div class="card-holder">
                <div class="card-box bg-news">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <h4>Pay $15/-</h4>
                            <form>
                                <div class="card-details">
                                    <h3 class="title">Credit Card Details</h3>
                                    <div class="row">
                                        <div class="form-group mt-3 fs-5  col-12">
                                            <label for="card-holder">Card Holder</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                                <input id="card-holder" type="text" class="form-control"
                                                    placeholder="Card Holder" aria-label="Card Holder"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 fs-5  col-md-6">
                                            <label for="">Expiration Date</label>
                                            <div class="input-group expiration-date">
                                                <input type="text" class="form-control" placeholder="MM" aria-label="MM"
                                                    aria-describedby="basic-addon1">
                                                <input type="text" class="form-control" placeholder="YY" aria-label="YY"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 fs-5  col-md-6">
                                            <label for="cvc">CVC</label>
                                            <input id="cvc" type="text" class="form-control" placeholder="CVC"
                                                aria-label="Card Holder" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="form-group mt-3 fs-5  col-12">
                                            <label for="card-number">Card Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                                                <input id="card-number" type="text" class="form-control"
                                                    placeholder="Card Number" aria-label="Card Holder"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 fs-5  col-12">
                                            <button type="button" class="btn btn-primary btn-block">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div><!--/col-lg-6 -->

                    </div><!--/row -->
                </div><!--/card-box -->
            </div><!--/card-holder -->

        </div><!--/container -->
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
