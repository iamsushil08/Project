<?php
session_start();

if (!isset($_SESSION['car_id'])) {
    echo "Car ID is missing.";
    exit;
}

$car_id = $_SESSION['car_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        .bookcarform{
            width:559px;
            margin-left:399px;
            margin-top:55px;
            height:355px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .labelforfrom{
            width:155px;
            height: 42px;
            border-radius:12px;

            
        }
        .forfrom{
            margin-left:133px;
            margin-top:2px;
            font-size:22px;
            
        }
        #to{
            width:155px;
            height: 42px;
            border-radius:12px;
        }
        .forto{
            margin-left:155px;
            font-size:22px;
            
        }
        .fromdate{
            margin-left:90px;
            font-size:22px;
        }
        #starting{
            width:155px;
            height: 42px;
            border-radius:12px;
            
        }
        #ending{
            width:155px;
            height: 42px;
            border-radius:12px;
            
        }
        .todate{
            margin-left:113px;
            font-size:22px;
        }
        #proceedtobooking{
            margin-left:123px;
            font-size:22px;
            width:300px;
            height:42px;
            border-radius:12px;
            cursor: pointer;
        }

    </style>
</head>

<body>

    <form class="bookcarform" method="POST" action="./payment.php">


        <input type="hidden" name="car_id" id="car_id" value="<?php echo htmlspecialchars($_SESSION['car_id']); ?>">
        <label class="forfrom" for=""> From:</label>
        <input class="labelforfrom" type="text" id="from" name="fromloc" placeholder="Enter pickup location" required>
        <br><br>


        <label class="forto" for="">To:<label>
                <input type="text" id="to" name="toloc" placeholder="Enter drop-off location" required>
                <br><br>


                <label class="fromdate" for="">From Date:</label>
                <input type="datetime-local" id="starting" name="start" required>
                <br><br>


                <label class="todate" for="">To Date:</label>
                <input type="datetime-local" id="ending" name="end" required>
                <br><br>


                <button id="proceedtobooking" type="submit" name="confirm">Proceed to Booking</button>
    </form>

</body>

</html>
<script>
document.querySelector('form').addEventListener('submit', function(a) {
    const starting = new Date(document.getElementById('starting').value);
    const ending = new Date(document.getElementById('ending').value);

    if (starting >= ending) {

        alert("End date must be after start date");
        a.preventDefault();

    }

})
// document.getElementById('starting').value = formatDate(now);
// document.getElementById('starting').placeholder = formatDate(now);

// document.getElementById('ending').value = formatDate(nextDay);
// document.getElementById('ending').placeholder = formatDate(nextDay);
</script>