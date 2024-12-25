<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Segoe UI Historic", "Segoe UI", Helvetica, Arial, sans-serif;
        background-color: #f8f9fa;
    }

    #form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    #form-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    #form-container input[type="text"],
    #form-container input[type="datetime-local"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .error {
        color: red;
        font-size: 12px;
        margin-bottom: 15px;
    }

    #submit-btn {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 18px;
        color: #ffffff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #submit-btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <form id="form-container" method="POST" action="./payment.php" onsubmit="return validateForm()">
        <label>From:
            <input type="text" id="from" name="fromloc" placeholder="Enter pickup location">
            <span id="fromloc_error" class="error"></span>
        </label>

        <label>To:
            <input type="text" id="to" name="toloc" placeholder="Enter drop-off location">
            <span id="toloc_error" class="error"></span>
        </label>

        <label>From Date:
            <input type="datetime-local" id="starting" name="start">
            <span id="start_error" class="error"></span>
        </label>

        <label>To Date:
            <input type="datetime-local" id="ending" name="end">
            <span id="end_error" class="error"></span>
        </label>

        <button id="submit-btn" type="submit">Proceed to Booking</button>
    </form>

    <script>
    function validateForm() {
        var isValidFrom = validateFromLocation();
        var isValidTo = validateToLocation();
        var isValidStart = validateStartDate();
        var isValidEnd = validateEndDate();

        return isValidFrom && isValidTo && isValidStart && isValidEnd;
    }

    function validateFromLocation() {
        var fromInput = document.getElementById("from").value.trim();
        var fromError = document.getElementById("fromloc_error");
        var locationPattern = /^[A-Za-z\s]+$/;

        if (fromInput === "") {
            fromError.innerHTML = "Pickup location cannot be empty.";
            return false;
        } else if (!locationPattern.test(fromInput)) {
            fromError.innerHTML = "Invalid location ";
            return false;
        } else {
            fromError.innerHTML = "";
            return true;
        }
    }

    function validateToLocation() {
        var toInput = document.getElementById('to').value.trim();
        var toError = document.getElementById("toloc_error");
        var locationPattern = /^[A-Za-z\s]+$/;

        if (toInput === "") {
            toError.innerHTML = "Drop-off location cannot be empty.";
            return false;
        } else if (!locationPattern.test(toInput)) {
            toError.innerHTML = "Invalid location";
            return false;
        } else {
            toError.innerHTML = "";
            return true;
        }
    }


    function validateStartDate() {
        var startInput = new Date(document.getElementById("starting").value);
        var startError = document.getElementById("start_error");
        var now = new Date();

        // Set seconds and milliseconds to 0 for comparison
        now.setSeconds(0);
        now.setMilliseconds(0);

        if (startInput > now) {
            startError.innerHTML = "";
            return true;
        }
    }






    function validateEndDate() {
        var startInput = new Date(document.getElementById("starting").value);
        var endInput = new Date(document.getElementById("ending").value);
        var endError = document.getElementById("end_error");

        if (isNaN(endInput)) {
            endError.innerHTML = "Please select a valid end date.";
            return false;
        } else if (endInput <= startInput) {
            endError.innerHTML = "End date must be after start date.";
            return false;
        } else {
            endError.innerHTML = "";
            return true;
        }
    }
    </script>
</body>

</html>