<?php  
include("../connect/connection.php");  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
        font-family: "Segoe UI Historic", "Segoe UI", Helvetica, Arial, sans-serif;
    }

    .search {
        text-align: center;
        margin: 20px;
        background-color: #fff;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .car-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        margin: 20px;
    }

    .car-container {
        display: flex;
        align-items: flex-start;
        gap: 30px;
        /* Increased gap between image and details */
        width: 100%;
        /* Full width of the page */
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
    }

    .car-image {
        flex: 0 0 300px;
        /* Increased size of the image container */
    }

    .car-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .car-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
        margin-left: 50px;
        /* Push details further to the right */
    }

    .car-details div {
        font-size: 18px;
        /* Slightly larger font */
        line-height: 1.6;
    }

    .car-details a {
        display: inline-block;
        padding: 10px;
        background-color: #C45946;
<<<<<<< HEAD
        color: white;
        text-decoration: none;
        border-radius: 5px;
=======
        color: #fff;
        border-radius: 20px;
        /* margin-left: 10px; */
        font-size: 14px;
        transition: background-color 0.3s ease;
        width: 300px;
>>>>>>> 0be039d0aeadf57ae22edacf06869316a7396a4f
    }

    .car-details a:hover {
        background-color: #0056b3;
    }

    h3 {
        text-align: center;
    }

    input[type="text"] {
        padding: 10px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 25px;
    }
<<<<<<< HEAD
=======
    .refreshpage{
        width: 175px;
        height:35px;
        margin-left: 329px; 
        border-radius: 12px;
        margin-top:53px;
        color:black;
        transition: box-shadow 0.3s ease;
        box-shadow: 0 0 8px rgba(196, 89, 52, 0.5);


>>>>>>> 0be039d0aeadf57ae22edacf06869316a7396a4f

    button {
        padding: 10px 20px;
        background-color: #C45946;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
    }
<<<<<<< HEAD

    button:hover {
        background-color: #0056b3;
=======
    .searchinginbooking{
        border-radius: 20px;
        width:270px;
        height:50px;
        outline: none;
        font-size: 14px;
        margin-left:155px;
        margin-top:33px;
        text-align:center;
        transition: box-shadow 0.3s ease;
        box-shadow: 0 0 8px rgba(196, 89, 52, 0.5);

>>>>>>> 0be039d0aeadf57ae22edacf06869316a7396a4f
    }
    </style>
</head>

<body>
    <!-- Static search form -->
    <div class="search">
        <form action="./search.php" method="GET">
            <input class="searchinginbooking" type="text" name="searching" placeholder="Search for cars" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <?php  
    if (isset($_GET['searching'])) { 
        $searching = $_GET['searching'];
        $sql = "SELECT * FROM cars WHERE name='$searching'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>ALL - AVAILABLE - CARS</h3>";
            echo "<div class='car-list'>"; // Wrap all cars in one container
            
            while ($car = mysqli_fetch_assoc($result)) {
                echo "<div class='car-container'>";
                
                // Car image on the left
                echo "<div class='car-image'>";
                echo "<img src='../" . $car['image_url'] . "' alt='" . $car['model'] . "'>";
                echo "</div>";

                echo "<div class='car-details'>";
                echo "<div><strong>Name:</strong> " . $car['name'] . "</div>";
                echo "<div><strong>Type:</strong> " . $car['type'] . "</div>";
                echo "<div><strong>Model:</strong> " . $car['model'] . "</div>";
                echo "<div><strong>Color:</strong> " . $car['color'] . "</div>";
                echo "<div><strong>Mileage:</strong> " . $car['mileage'] . " km/l</div>";
                echo "<div><strong>No of Seats:</strong> " . $car['noofseats'] . "</div>";
                echo "<div><strong>Charge:</strong> " . $car['charge'] . "</div>";
                echo "<div><strong>Status:</strong> " . $car['status'] . "</div>";
                echo "<div><strong>Plate Number:</strong> " . $car['plate_number'] . "</div>";

                // Action button based on availability
                if ($car['status'] === 'Available') {
                    echo "<div><a href='checkuser.php?car_id=" . $car['id'] ."'>Book now</a></div>";
                } else {
                    echo "<div>Rented Out</div>";
                }
                echo "</div>"; // Closing car-details div
                
                echo "</div>"; // Closing the car-container div
            }
            
            echo "</div>"; // Closing car-list div
        } else {
            echo "<h3 style='text-align:center;'>No cars found matching your search.</h3>";
        }
    }
    ?>
</body>

</html>