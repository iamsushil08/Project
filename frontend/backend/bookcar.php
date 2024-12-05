<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>

<body>

    <form method="POST" action="./payment.php">


        <input type="hidden" name="car_id" id="car_id" value="<?php echo htmlspecialchars($car_id); ?>">
        <input type="hidden" name="car_charge" value="<?php echo htmlspecialchars($car['charge']); ?>">


        <label for="">From:</label>
        <input type="text" id="from" name="fromloc" placeholder="Enter pickup location" required>
        <br><br>


        <label for="">To:<label>
                <input type="text" id="to" name="toloc" placeholder="Enter drop-off location" required>
                <br><br>


                <label for="">From Date:</label>
                <input type="datetime-local" id="starting" name="start" required>
                <br><br>


                <label for="">To Date:</label>
                <input type="datetime-local" id="ending" name="end" required>
                <br><br>


                <button type="submit" name="confirm">Proceed to Booking</button>
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