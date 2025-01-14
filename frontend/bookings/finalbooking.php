<?php
session_start();
include('../connect/connection.php');


if (!isset($_SESSION['email'])) {
    header("Location:../connect/diffsignup.php");
    exit;
}

$user_email = $_SESSION['email'];
$query_user = "SELECT user_id FROM users WHERE email = '$user_email'";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_assoc($result_user);
$user_id = $user['user_id'];

// Query booking details
$query = "SELECT r.*, c.name, c.description, c.color, c.charge FROM reservationS r INNER JOIN cars c ON r.car_id = c.id WHERE r.user_id = '$user_id' ORDER BY r.id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$details = mysqli_fetch_assoc($result);

// Escape output
$name = htmlspecialchars($details['name']);
$description = htmlspecialchars($details['description']);
$color = htmlspecialchars($details['color']);
$charge = htmlspecialchars($details['charge']);
$fromloc = htmlspecialchars($details['fromloc']);
$toloc = htmlspecialchars($details['toloc']);
$start_time = date('Y-m-d H:i:s', strtotime($details['start_time']));
$end_time = date('Y-m-d H:i:s', strtotime($details['end_time']));
$totalpayment = number_format($details['total_payment'], 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Quicksand:wght@500&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: "Segoe UI Historic", "Segoe UI", Helvetica, Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    .container {
        max-width: 1000px;
        margin: 30px auto;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;

    }

    h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    h2 {
        font-size: 24px;
        color: #4e73df;
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        margin-top: 33px;
        justify-content: space-around;
    }

    .details-box {
        background: #f9f9f9;
        border-radius: 10px;
        width: 35%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .details-boxx {
        width: 35%;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .details-box p {
    font-size: 18px;
    color: #555;
    line-height: 1.8;
    margin: 0 4 10px;
    display: flex;
    justify-content: space-between;
}
.details-boxx p {
    font-size: 18px;
    color: #555;
    line-height: 1.8;
    margin: 0 3 10px;
    display: flex;
    justify-content: space-between;
}


    .highlight {
        font-weight: bold;
        color: #222;
        justify-content:center;
        align-items: center;
    }

    .button-container {
        margin-top: 20px;
        width:500px;
        margin-left:235px;
    }


    .recalculate-btn,
    .paypal-btn {
        background: #4e73df;
        color: white;
        padding: 15px 30px;
        font-size: 18px;
        border: none;
        width: 100%;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin: 10px 0;
    }

    /* .recalculate-btn:hover,
    .paypal-btn:hover {
        background-color: #375a7f;
    } */

    .footer {
        font-size: 14px;
        color:black;
        margin-top: 30px;
    }

    .footer a {
        color: gray;
        text-decoration: none;
        font-weight: 600;
    }

    .footer a:hover {
        color: #005f8c;
        text-decoration: underline;
    }
    #paypal-button-container{
        margin-left:133px;
        border-radius:22px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <h2>Car Rental Details</h2>

        <div class="row">
            <div class="details-boxx">
                <p><span class="highlight">Car Name:</span> <?php echo $name; ?></p>
                <p><span class="highlight">Description:</span> <?php echo $description; ?></p>
                <p><span class="highlight">Color:</span> <?php echo $color; ?></p>
                <p><span class="highlight">Charge/Hour:</span> $<?php echo $charge; ?> USD</p>
            </div>

            <div class="details-box">
                <p><span class="highlight">Pickup Location:</span> <?php echo $fromloc; ?></p>
                <p><span class="highlight">Drop-off Location:</span> <?php echo $toloc; ?></p>
                <p><span class="highlight">Start Date:</span> <?php echo $start_time; ?></p>
                <p><span class="highlight">End Date:</span> <?php echo $end_time; ?></p>
                <p><span class="highlight">Total Payment:</span> $<?php echo $totalpayment; ?> USD</p>
            </div>
        </div>

        <div class="button-container">
            <!-- Recalculate Button -->
            <button class="recalculate-btn" onclick="window.location.reload();">Recalculate</button>
        </div>

        <!-- PayPal Button -->
        <div id="paypal-button-container" style="margin-top: 20px;"></div>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="#contactsection">contact us</a>.</p>
        </div>
    </div>

    <script
        src="https://www.paypal.com/sdk/js?client-id=AfrxsugjDF5UzPrGu9K5OWvVkWDIbNIZ9prfcwu1lOhZNk_b7Qb80O79G60MO92hOk7S_BMAGfMj_lGp&currency=USD">
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
                            value: "<?php echo $totalpayment; ?>"
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    window.location.href = "./paid.php";
                    const element = document.getElementById('paypal-button-container');
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