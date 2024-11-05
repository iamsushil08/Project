<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    <style>
    /* Style the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        width: 100px;
        height: auto;
    }

    form {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <!-- Search form -->
    <form action="search.php" method="GET">
        <input type="text" name="searching" placeholder="Search for cars" required>
        <button type="submit">Search</button>
    </form>

    <?php 
    session_start(); // Start the session

    include("connection.php"); // Include the database connection

    // Check if there is a search query
    if (isset($_GET['searching'])) {
        $searching = $_GET['searching'];

        // Run a query to search for cars by name
        $query = "SELECT * FROM cars WHERE name = '$searching'";
        $result = mysqli_query($conn, $query);

        // Check if any cars are found
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Car Name</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Mileage</th>
                    <th>Description</th>
                    <th>Extra Charge</th>
                    <th>Status</th>
                    <th>Plate Number</th>
                    <th>Action</th>
                  </tr>";

            // Display each car's details
            while ($car = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $car['name'] . "</td>";
                echo "<td><img src='" . $car['image_url'] . "' alt='" . $car['model'] . "'></td>";
                echo "<td>" . $car['color'] . "</td>";
                echo "<td>" . $car['mileage'] . " km/l</td>";
                echo "<td>" . $car['description'] . "</td>";
                echo "<td>" . $car['extra_charge'] . "</td>";
                echo "<td>" . $car['status'] . "</td>";
                echo "<td>" . $car['plate_number'] . "</td>";

                // Show Book Now or Login to Book button based on login status
                if ($car['status'] === 'Available') {
                    // Check if the user is logged in
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, go to payment.php
                        echo "<td><a href='payment.php?car_id=" . $car['id'] . "&extra_charge=" . $car['extra_charge'] . "'>Book Now</a></td>";
                    } else {
                        // User is not logged in, go to login or signup
                        echo "<td><a href='signup.php'>Login to Book</a></td>";
                    }
                } else {
                    echo "<td>Rented Out</td>";
                }

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No cars found with the specified model.</p>";
        }
    }
    ?>
</body>

</html>