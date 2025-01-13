<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Refresh for Cars Update</title>
    <script>
    function checkForUpdates() {
        fetch('./bookings/updatecars.php')
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
    }


    setInterval(checkForUpdates, 60000);
    </script>
</head>

<body>

</body>

</html>