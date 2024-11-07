<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DriveZy</title>
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div id="mainmenu">
        <div id="logo">
            <img id="drivezylogo" src="./images/logo.png" alt="DriveZy Logo" />
        </div>
        <div id="menuBar">
            <a id="home" href="./index.html">Home</a>
            <a id="about" href="#blogs">About</a>
            <a id="contact" href="#infoo">Contact Us</a>
            <a id="blog" href="">FAQs</a>
            <a id="login" href="./backend/signup.php">Log in</a>
        </div>
        <div id="medialogo">
            <a href="./backend/search.php">
                Search Cars</a>
        </div>
    </div>
    <img id="car1" src="./images/Homepage-Cybertruck-Desktop-v3.avif" alt="Car Image" />
    <div id="text1">
        <h1>WE ARE HERE TO <span style="color: black">TAKE YOU THERE</span> ?</h1>
    </div>
    <?php
// Include the database connection file
include './backend/connection.php';


$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
?>

    <div id="div00">
        <h1>Available Cars</h1>

        <div class="car-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($car = mysqli_fetch_assoc($result)): ?>
            <div class="car-item">

                <?php if (!empty($car['image_url'])): ?>
                <img src="./backend/<?php echo htmlspecialchars($car['image_url']); ?>">
                <?php else: ?>
                <p>No image available</p>
                <?php endif; ?>


                <h3><?php echo htmlspecialchars($car['name']); ?></h3>
                <p>Cost:<?php echo number_format($car['extra_charge'], 0). '/hr';?></p>
                <p>Mileage: <?php echo htmlspecialchars($car['mileage']).'/km';?> </p>
                <p class="<?php echo ($car['status'] === 'Available') ? 'status-available' : 'status-unavailable'; ?>">
                    Status: <?php echo htmlspecialchars($car['status']); ?>
                </p>

            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No cars available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php

mysqli_close($conn);
?>



    <!-- <img id="car2" src="./images/car4.webp" alt="" /> -->

    <hr />
    <div id="div1">
        <p id="rental1">Skip the rental counter</p>
        <h1 id="rentalhead">Discover our Car Rental Marketplaces</h1>
        <div id="div2">
            <div>
                <img id="img1con" src="./images/infinity.jpg" alt="Endless Options" />
                <p id="endless">Endless options</p>
                <p>
                    Choose from thousands of vehicles you won't find anywhere else. Choose it and get picked up where
                    you want
                    it.
                </p>
            </div>
            <div>
                <img id="img2con" src="./images/fa headset.jpg" alt="Customer Support" />
                <p id="customer">24/7 customer support</p>
                <p>
                    Rest easy knowing that everyone in the Sajilo rental community is screened, and 24/7 customer
                    support and
                    roadside assistance are just a click away.
                </p>
            </div>
            <div>
                <img id="img3con" src="./images/fa sheild.jpg" alt="Confidence" />
                <p id="trip">Go for a trip confidently</p>
                <p>
                    Go for a trip confidently with your choice of protection plans — all plans include varying levels of
                    liability insurance provided through Sajilo Rental's Insurance Agency.
                </p>
            </div>
        </div>
        <div id="perfect-car"><a id="perfectt-car" href="./backend/search.php"> Book the Perfect Car</a></div>

        <div id="fleet">
            <h2 id="fleett">Explore the Drivezy car Fleet</h2>
            <p id="fleettt">
                Where your journey begins with an exquisite fleet of vehicles for an unforgettable experience.
            </p>
        </div>
        <div id="blogs">
            <div id="blogss">
                <h2>Dashain Travels Made Easy with DriveZy Car Rental: Pre-Booking Now Open!</h2>
                <p id="text">
                    This year, DriveZy Car Rental is here to make your Dashain travels easier than ever, offering
                    pre-booking
                    services to help you secure the pe..
                </p>
                <div id="readmore">
                    <a id="more" href="">Read more</a>
                </div>
            </div>
            <div id="blogsss">
                <h2>Hiace Van Rental in Kathmandu, Nepal</h2>
                <p id="textt">
                    Hiace van rental in Kathmandu, Nepal is best when you are traveling in a group, renting a Hiace in
                    Kathmandu
                    can be the perfect solution.
                </p>
                <div id="readmore">
                    <a id="more" href="">Read more</a>
                </div>
            </div>
            <div id="blogssss">
                <h2>Why Customers Love Renting from DriveZy: Nepals Leading Vehicle Rental</h2>
                <p id="texttt">
                    As Nepal's first ISO-certified vehicle rental company, DriveZy Car has set the benchmark for
                    quality,
                    reliability, and customer satisfaction..
                </p>
                <div id="readmore">
                    <a id="more" href="">Read more</a>
                </div>
            </div>
        </div>
        <h1 id="packages">Our Special Packages</h1>
        <p id="packagess">
            Where your journey begins with an exquisite fleet of vehicles for an unforgettable experience.
        </p>
        <img id="images00" src="./images/images00.webp" alt="Special Packages" />
        <div id="infoo">
            <div id="info">


            </div>
        </div>


</html>