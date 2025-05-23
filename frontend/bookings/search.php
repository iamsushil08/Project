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
        border-radius: 3px;

    }

    .search input,
    .search button {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 25px;


    }

    .search button {
        background-color: #C45946;
        color: White;
    }

    .car-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin: 20px;
    }

    .car-container {
        width: 100%;
        max-width: 700px;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 20px;
        border: 1px solid #ddd;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
    }

    .car-image img {
        width: 400px;
        height: auto;
        border-radius: 8px;
        margin-top: 13px;
    }

    .car-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .car-details a {
        padding: 10px;
        background-color: #C45946;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .car-details a:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="search">
        <form action="./search.php" method="GET">
            <input type="text" name="searching" placeholder="Search for cars" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <?php  
    if (isset($_GET['searching'])) {
        $searching =  $_GET['searching']; 
        $sql = "SELECT * FROM cars WHERE name LIKE '%$searching%'"; 
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3 style='text-align:center;'>ALL - AVAILABLE - CARS</h3>";
            echo "<div class='car-list'>";
            
            while ($car = mysqli_fetch_assoc($result)) {
                echo "<div class='car-container'>";
                echo "<div class='car-image'>";
                echo "<img src='../" . htmlspecialchars($car['image_url']) . "' alt='" . htmlspecialchars($car['model']) . "'>";
                echo "</div>";
                echo "<div class='car-details'>";
                echo "<div><strong>Name:</strong> " . htmlspecialchars($car['name']) . "</div>";
                echo "<div><strong>Type:</strong> " . htmlspecialchars($car['type']) . "</div>";
                echo "<div><strong>Model:</strong> " . htmlspecialchars($car['model']) . "</div>";
                echo "<div><strong>Color:</strong> " . htmlspecialchars($car['color']) . "</div>";
                echo "<div><strong>Mileage:</strong> " . htmlspecialchars($car['mileage']) . " km/l</div>";
                echo "<div><strong>No of Seats:</strong> " . htmlspecialchars($car['noofseats']) . "</div>";
                echo "<div><strong>Charge:</strong> " . htmlspecialchars($car['charge']) . "</div>";
                echo "<div><strong>Status:</strong> " . htmlspecialchars($car['status']) . "</div>";
                echo "<div><strong>Plate Number:</strong> " . htmlspecialchars($car['plate_number']) . "</div>";
                if ($car['status'] === 'available') {
                    echo "<div><a href='checkuser.php?id=" . $car['id'] ."'>Book now</a></div>";
                } else {
                    echo "<div style='color:red';>Rented Out</div>";
                }
                echo "</div>"; 
                echo "</div>"; 
            }
            echo "</div>";
        } else {
            echo "<h3 style='text-align:center;'>No cars found matching your search.</h3>";
        }
    }
    ?>
    <div style='position: fixed; bottom: 12px; left: 10px;'>
        <a href="../index.php"
            style="text-decoration: none; padding: 10px 10px; background-color: #C45946; color: white; border-radius:6px;">Go
            Back</a>
    </div>


</body>

</html>