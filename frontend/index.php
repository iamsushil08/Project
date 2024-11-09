<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DriveZy</title>
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <div id="mainmenu">
        <div id="logo">
            <a href="./index.php"><img id="drivezylogo" src="./images/logo.png" alt="DriveZy Logo" /></a>
        </div>
        <div id="menuBar">
            <a id="home" href="./index.php">Home</a>
            <a id="about" href="#blogs">About</a>
            <a id="contact" href="#contactSection">Contact Us</a>
            <a id="blog" href="#faqSection">FAQs</a>
            <a id="search" href="./backend/search.php">Search</a>
        </div>
        <div id="righty">
            <a href="./backend/register.html" style="color: black;">Register |</a>

            <a href="./backend/signup.php" class="login-btn">Log In</a>


        </div>
    </div>

    <div id="Main">
        <img id="car1" src="./images/Homepage-Cybertruck-Desktop-v3.avif" alt="Car Image" />
        <div id="text1">
            <h1>WE ARE HERE TO <span style="color: black">TAKE YOU THERE</span> ?</h1>
        </div>

    </div>
    <!-- second page ho -->
    <div id="div00">

        <?php

include './backend/connection.php';


$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
?>




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



    <!-- third page ho hai -->
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
        <div id="blogss">
            <h2>Hiace Van Rental in Kathmandu, Nepal</h2>
            <p id="textt">
                Hiace van rental in Kathmandu, Nepal is best when you are traveling in a group, renting a Hiace
                in
                Kathmandu
                can be the perfect solution.
            </p>
            <div id="readmore">
                <a id="more" href="">Read more</a>
            </div>
        </div>
        <div id="blogss">
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
    <div id="div1">

        <h1 id="rentalhead">Discover our Car Rental Marketplaces</h1>
        <div id="div2">
            <div>
                <img id="img1con" src="./images/infinity.jpg" alt="Endless Options" />
                <p id="endless">Endless options</p>
                <p>
                    Choose from thousands of vehicles you won't find anywhere else. Choose it and get picked up
                    where
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
                    Go for a trip confidently with your choice of protection plans — all plans include varying
                    levels of
                    liability insurance provided through Sajilo Rental's Insurance Agency.
                </p>
            </div>
        </div>
        <div id="perfect-car"><a id="perfectt-car" href="./backend/search.php"> Book the Perfect Car</a></div>

    </div>


    <div id="contactSection">
        <h2>Do you have any queries?</h2>
        <form id="contactForm" method="POST" action="submitcontact.php">
            <input type="text" name="name" id="name" placeholder="Your Name" required>
            <input type="email" name="email" id="email" placeholder="Your Email" required>
            <input type="tel" name="phone" id="phone" placeholder="Your Phone" required>
            <textarea name="message" id="message" placeholder="Your Message" required></textarea>
            <button type="submit" id="sendMessageBtn">Send Message</button>
        </form>
    </div>
    <div id="faqSection">
        <h2>Frequently Asked Questions</h2>

        <div class="faqItem">
            <h3 class="question">1. How do I book a car?</h3>
            <p class="answer">You can book a car by selecting your desired car model, rental dates, and filling out
                the booking form. Make sure you are logged in to complete the booking.</p>
        </div>

        <div class="faqItem">
            <h3 class="question">2. What are the requirements for renting a car?</h3>
            <p class="answer">To rent a car, you must be at least 18 years old and hold a valid driver’s license.
                Additional age requirements or fees may apply depending on the car model.</p>
        </div>

        <div class="faqItem">
            <h3 class="question">3. How does the payment process work?</h3>
            <p class="answer">You are required to make a 15% down payment during booking. The remaining balance can
                be paid at the time of car pickup. We accept various payment methods for your convenience.</p>
        </div>

        <div class="faqItem">
            <h3 class="question">4. Can I cancel my booking?</h3>
            <p class="answer">Yes, you can cancel your booking up to 24 hours before your rental start time. Please
                note that cancellation fees may apply. Check our cancellation policy for details.</p>
        </div>

        <div class="faqItem">
            <h3 class="question">5. Are there any additional charges?</h3>
            <p class="answer">Additional charges may apply for late returns, extra mileage, or specific car models.
                Details of additional charges will be displayed during the booking process.</p>
        </div>
    </div>

    <footer>
        <div class="footer-container">

            <div class="footer-section about">
                <h3>About Us</h3>
                <p>
                    Founded in 2024 by two ambitious students, DrivZy is set to become Nepal's premier vehicle
                    rental service, providing an exceptional travel experience. With a dedication to quality, DrivZy
                    offers car rentals across Nepal, delivering reliability and affordability.
                </p>
            </div>


            <div class="footer-section contact-info">
                <h3>Contact Info</h3>
                <p> <i class="fas fa-map-marker-alt"></i>Rupandehi,Nepal</p>
                <p><i class="fas fa-phone"></i>9867556559</p>
                <p><i class="fas fa-envelope"></i><a href="mailto:paudelsandhya1588@gmail.com">paudelsadhya@gmail.com
                </p>


            </div>


            <div class="footer-section quick-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#blogs">About</a></li>
                    <li><a href="#faqSection">FAQs</a></li>
                    <li><a href="#contactSection">Contact</a></li>
                    <li><a href="./backend/register.html">Register</a></li>
                </ul>

            </div>

            <div class="footer-section social-network">
                <h3>Social Network</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i>
                    </a>
                    <a href="#"> <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"> <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#"> <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>


    </footer>








</html>
<script>
document.querySelectorAll(".question").forEach(question => {
    question.addEventListener("click", () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle("active");

        const answer = faqItem.querySelector(".answer");
        answer.style.display = answer.style.display === "block" ? "none" : "block";
    });
});
</script>