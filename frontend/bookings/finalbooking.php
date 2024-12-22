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
</head>

<body>
    <h1>Final Booking</h1>
    <div>
        <h2>Car Details</h2>
        <p><strong>Car Name:</strong> <?php echo htmlspecialchars($car['name']); ?></p>
        <p><strong>Car Description:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
        <p><strong>Car Color:</strong> <?php echo htmlspecialchars($car['color']); ?></p>
        <p><strong>Car Charge per Hour:</strong> <?php echo htmlspecialchars($car['charge']); ?></p>
        <p><strong>Total Payment:</strong> <?php echo number_format($totalpayment, 2); ?></p>
        <p><strong>Down Payment (15%):</strong> <?php echo number_format($downpay, 2); ?></p>
    </div>

    <h2>Booking Details</h2>
    <p><strong>From:</strong> <?php echo htmlspecialchars($fromloc); ?></p>
    <p><strong>To:</strong> <?php echo htmlspecialchars($toloc); ?></p>
    <p><strong>Start Time:</strong> <?php echo $start_time; ?></p>
    <p><strong>End Time:</strong> <?php echo $end_time; ?></p>


    <form action="./processpayment.php" method="POST">
        <input type="hidden" name="downpay" value="<?php echo $downpay; ?>">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <div id="smart-button-container">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
            data-sdk-integration-source="button-factory"></script>
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
                            "amount": {
                                "currency_code": "USD",
                                " "
                                value ": "
                                <?php echo $downpay; ?> " 
                            }
                        }]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null,
                            2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        element.innerHTML = '';
                        element.innerHTML = '<h3>Thank you for your payment!</h3>';

                        // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
        </script>
    </form>
</body>

</html>