<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <style>
    body {
        margin: 0px;
        padding: 0px;
        background-color: #f2f2f2;
        height: 100vh;
        font-family: "Segoe UI Historic",
            "Segoe UI",
            Helvetica,
            Arial,
            sans-serif;
    }

    table {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 5px;
        border-radius: 2px;

    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }


    img {
        width: 100px;
        height: auto;
    }



    #drivezylogo {
        height: 60px;
        width: auto;

    }

    nav {
        height: 60px;
        display: flex;
        background-color: white;
        align-items: center;
        padding-left: 4px;

    }

    button {
        height: 40px;
        padding: 5px 10px;
        border: none;
        background-color: red;
        color: white;
        border-radius: 5px;

    }

    form {
        display: flex;
        align-items: center;
        margin-left: 600px;
    }

    input[type="text"] {
        width: 300px;
        padding: 10px;
        border-radius: 50px;
        border: 1 px;
        height: 20px;


    }

    input[type="text"]::placeholder {

        font-size: 15px;
        color: #aaa;

    }



    h3 {
        text-align: center;

    }
    </style>
</head>

<body>
    <nav>
        <button onclick="history.back()">Go Back</button>
        <img src="../images/drivzy (2).png" alt="" id="drivezylogo">

        <form action=" search.php" method="GET">
            <input type="text" name="searching" placeholder="Search for cars" required>
            <button type="submit">Search</button>
        </form>

    </nav>


    <?php 
  

    include("connection.php"); 


    if (isset($_GET['searching'])) {
        $searching = $_GET['searching'];

        
        $query = "SELECT * FROM cars WHERE name = '$searching'";
        $result = mysqli_query($conn, $query);

        
        if (mysqli_num_rows($result) > 0) {
            echo"<h3> ALL - AVAILABLE - CARS</h3>";
            echo "<table>";
            echo "<tr>
                    <th>Car Name</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Mileage</th>
                    <th>Description</th>
                    <th>Charge</th>
                    <th>Status</th>
                    <th>Plate Number</th>
                    <th>Action</th>
                  </tr>";


            while ($car = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $car['name'] . "</td>";
                echo "<td><img src='" . $car['image_url'] . "' alt='" . $car['model'] . "'></td>";
                echo "<td>" . $car['color'] . "</td>";
                echo "<td>" . $car['mileage'] . " km/l</td>";
                echo "<td>" . $car['description'] . "</td>";
                echo "<td>" . $car['charge'] . "</td>";
                echo "<td>" . $car['status'] . "</td>";
                echo "<td>" . $car['plate_number'] . "</td>";

                
                if ($car['status'] === 'Available') {
                  
                        echo "<td><a href='checkuser.php?car_id=" . $car['id'] ."'>Book now</a></td>";
                    
                }
                 else {
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