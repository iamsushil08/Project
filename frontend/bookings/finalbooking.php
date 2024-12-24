<?php
session_start();
include('../connect/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location:../connect/diffsignup.php");
    exit;
}


if (!isset($_SESSION['details'])) {
    echo "No booking details found.";
    exit;
}


$details = $_SESSION['details'];
$car_id = $details['car_id'];
$fromloc = $details['fromloc'];
$toloc = $details['toloc'];
$start_time = date('Y-m-d H:i:s', $details['start_time']);
$end_time = date('Y-m-d H:i:s', $details['end_time']);
$totalpayment = $details['totalpayment'];
$downpay = $details['downpay'];


$query = "SELECT * FROM cars WHERE id = '$car_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $car = mysqli_fetch_assoc($result);
} else {
    echo "Car details not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Booking</title>
    <style>
    /* body { 
        margin: 0px;
        padding: 0px;
        background-color: red;
        display: flex;
        align-items: right;
        justify-content: center;
    /* } */

    .box {
        height: 390px;
        width: 450px;
         /* background-color:red; */
        color:black;
        margin-top:40px;
        margin-left:475px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

    }
    #heading{
        margin-left:113px;
    }
    #heading2{
        margin-left:153px;
    }
    #name{
        margin-left:53px;
        margin-top:2px;
    }
    #description {
        margin-left:53px;
    }
    #color{
        margin-left:53px;
    }
    #hour{
        margin-left:53px;
    
    }
    #totalpayment{
        margin-left:53px;
    }
    #downpayment{
        margin-left:53px;
    }
    #paypal-button-container{
        margin-left:557px;
        width:315px;
        border-radius:12px;
        margin-top:22px;
    }
    /* #smart-button-container{ */
        /* height:333px; */
        /* width: 666px; */
        /* background-color: red; */

    /* } */
    /* #smart{ */
        /* style="text-align: center; */
        /* margin-left:33px; */
        /* width: 559px; */

    /* } */
    </style>
</head>

<body>

    <div class="box">
        <h1 id="heading">Final Booking</h1>
        <h2 id="heading2">Car Details</h2>
        <p id="name"><strong>Name:</strong> <?php echo htmlspecialchars($car['name']); ?></p>
        <p id="description" ><strong>Description:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
        <p id="color" ><strong>Color:</strong> <?php echo htmlspecialchars($car['color']); ?></p>
        <p id="hour"><strong>Charge/Hour:</strong> <?php echo htmlspecialchars($car['charge']); ?></p>
        <p id="totalpayment"><strong>Total Payment:</strong> <?php echo number_format($totalpayment, 2); ?></p>
        <p id="downpayment"><strong>Down Payment (15%):</strong> <?php echo number_format($downpay, 2); ?></p>
    </div>
    <!-- <div class="box2">

        <h2>Booking Details</h2>
        <p><strong>From:</strong> <?php echo htmlspecialchars($fromloc); ?></p>
        <p><strong>To:</strong> <?php echo htmlspecialchars($toloc); ?></p>
        <p><strong>Start Time:</strong> <?php echo $start_time; ?></p>
        <p><strong>End Time:</strong> <?php echo $end_time; ?></p>
    </div> -->


    <!-- <div id=" smart-button-container"> -->
        <!-- <div id="smart" > -->
            <div id="paypal-button-container"></div>
        <!-- </div> -->
    <!-- </div> -->

    <script
        src="https://www.paypal.com/sdk/js?client-id=AfrxsugjDF5UzPrGu9K5OWvVkWDIbNIZ9prfcwu1lOhZNk_b7Qb80O79G60MO92hOk7S_BMAGfMj_lGp&currency=USD"
        data-sdk-integration-source="button-factory">
    </script>
    <script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                 shape: 'rect',
                 color: 'gold',
                 layout: 'vertical',
                 label: 'paypal',
             },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: "USD",
                            value: "<?php echo $totalpayment; ?>" // Dynamically pass PHP variable
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';
                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
    </script>

</body>

</html>