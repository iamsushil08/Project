<?php 
session_start();
$message="";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<?php
include('./connect/connection.php');
include('./bookings/updatecars.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DRIVZY</title>
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <div id="mainmenu">
        <div id="logo">
            <a href="./index.php"><img id="drivezylogo" src="./images/drivzy (2).png " alt=" DriveZy Logo" /></a>
        </div>
        <div id="menuBar">
            <a id="home" href="./index.php">Home</a>
            <a id="about" href="#page2">About</a>
            <a id="contact" href="#contactsection">Contact Us</a>
            <a id="blog" href="#faqSection">FAQs</a>
            <a id="search" href="./bookings/search.php">Search
            </a>
        </div>

        <div id="righty">
            <?php 
    include("./connect/connection.php");

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query = "SELECT username, email, profile_image FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error fetching data: " . mysqli_error($conn);
        }

        if (mysqli_num_rows($result) > 0) {
            $users = mysqli_fetch_assoc($result);
        } else {
            $users = null;
        }
    }
?>

            <?php if (isset($_SESSION['email']) && isset($users['profile_image'])): ?>
            <div id="uection" onmouseover="toggleProfile(true)" onmouseout="toggleProfile(false)">

                <img src="<?php echo $users['profile_image']; ?>" id="profileImage" class="circular">

                <div id="slidesection">
                    <h2>Your Dashboard</h2>
                    <h3><?php echo $users['username']; ?></h3>
                    <p><?php echo $users['email']; ?></p>
                    <a href="" id="bluebtn">Edit Profile</a>
                    <a href="./bookings/reservation.php" id="bluebtn">Your Reservations</a>

                    <a href="./connect/logout.php" id="bluebtn">Log Out</a>
                </div>
            </div>

            <script>
            function toggleProfile(show) {
                const slidesection = document.getElementById("slidesection");

                if (show) {
                    slidesection.classList.add("show");
                } else {
                    slidesection.classList.remove("show");
                }
            }
            </script>

            <?php else: ?>
            <a href="./connect/signup.php">Login </a> | <a href="./connect/register.html">Register</a>
            <?php endif; ?>


        </div>


    </div>


    <div id=" Main">
        <img id="car1" src="./images/Homepage-Cybertruck-Desktop-v3.avif" alt="Car Image" />
        <div id="text1">
            <h1>DRIVZY MAKES YOUR TRAVEL EASY :<span style="color: black">BOOK US NOW!</span></h1>
        </div>

    </div>

    <div id="div00">

        <?php

include ("./connect/connection.php"); 


 $sql = "SELECT * FROM cars";
 $result = mysqli_query($conn, $sql);
 ?>

        <div class="car-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($car = mysqli_fetch_assoc($result)): ?>
            <div class="car-item" id="car-item-<?php echo $car['id']; ?>">
                <?php if (!empty($car['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="Car Image">
                <?php else: ?>
                <p>No image available</p>
                <?php endif; ?>

                <h3><?php echo htmlspecialchars($car['name']); ?></h3>

                <button class="view-details-btn" onclick="toggleDetails(<?php echo $car['id']; ?>)">View
                    Details</button>

                <div class="car-details" id="details-<?php echo $car['id']; ?>" style="display: none;">
                    <p>Cost: $<?php echo number_format($car['charge'], 0) . '/hr'; ?></p>
                    <p>Mileage: <?php echo htmlspecialchars($car['mileage']) . ' km/l'; ?> </p>
                    <p
                        style="color: <?php echo ($car['status'] === 'available') ? 'green' : ($car['status'] === 'booked' ? 'red' : 'black'); ?>;">

                        Status: <?php echo htmlspecialchars($car['status']); ?>
                    </p>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No cars available at the moment.</p>
            <?php endif; ?>
        </div>




        <script>
        function toggleDetails(carId) {
            var carItem = document.getElementById('car-item-' + carId);
            var detailsDiv = document.getElementById('details-' + carId);
            var button = document.querySelector('#car-item-' + carId + ' .view-details-btn');

            if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
                detailsDiv.style.display = 'block';
                carItem.style.height = '350px';
                button.textContent = 'Hide Details';
            } else {
                detailsDiv.style.display = 'none';
                carItem.style.height = '250px';
                button.textContent = 'View Details';
            }
        }
        </script>



        <?php

mysqli_close($conn) ; 
?>


        <div id="page2">
            <h3>
                Hiring a vehicle? You're at the right place.
                <p>drivZy Car, तपाइको यात्राको सहयात्री।</p>
            </h3>
            <img id="car2" src="./images/car4.webp" alt="" />

            <h2 id="h">Our Latest Blogs</h2>
            <div id="blogs">

                <div class="blogss">
                    <h2>Why <span>DRIVZY</span> is Nepal's Best Car Rental Company ? :Trust, Quality and
                        Reliability
                    </h2>
                    <p class="text">

                        DRIVZY is one of the most recognized car rental company of Nepal,We assure trust,quality
                        and
                        reliability of our clients.
                        <a href="" class="more">Readmore</a>
                    </p>




                </div>

                <div class="blogss">
                    <h2>Planning a Group Trip to Pokhara? Rent a Scorpio Now!</h2>
                    <p class="textt">
                        Be one among

                        hundreds of renters :
                        Rent a scorpio now to take a break from daily hustle, enjoy the winter vibes in pokhara!
                        <a href="" class="more">Readmore</a>
                    </p>




                </div>

                <div class="blogss">
                    <h2>The Ultimate Christmas Road Trip: Pre-Book with DRIVZY Car Rentals Today</h2>
                    <p class="text">
                        This holiday season, make your Christmas road trip unforgettable with DRIVZY Car
                        Rentals!

                        <a href="" class="more">Readmore</a>


                    </p>





                </div>

            </div>
        </div>
        <div id="div1">

            <h1>Discover our Car Rental Marketplaces</h1>


            <div class="imagecontainer">
                <div class="image">
                    <img class="img1con" src="./images/infinity.jpg" alt="Endless Options" />
                    <p id="endless">Endless options</p>
                    <p>
                        Choose from hundreds of vehicles you won't find anywhere else. Choose it and get picked
                        up
                        where
                        you want
                        it.
                    </p>
                </div>
                <div class="image">
                    <img class="img1con" src="./images/fa headset.jpg" alt="Customer Support" />
                    <p id="customer">24/7 customer support</p>
                    <p>
                        Rest easy knowing that everyone in the Drivzy rental company is screened and 24/7
                        customer
                        support also
                        roadside assistance are just a click away.
                    </p>
                </div>
                <div class="image">
                    <img class="img1con" src="./images/fa sheild.jpg" alt="Confidence" />
                    <p id="trip">Go for a trip confidently</p>
                    <p>
                        Go for a trip confidently with your choice of protection plans — all plans include
                        varying
                        levels of
                        liability insurance provided through Drivzy Rental's Insurance Agency.
                    </p>
                </div>
            </div>

            <div id="perfect-car"><a id="perfectt-car" href="./bookings/search.php"> Book the Perfect Car</a>
            </div>


        </div>


        <div id="contactsection">

            <div id="formhere">
                <h2>Do you have any queries?</h2>
                <form id="contactForm" method="POST" action="./dashboard/submitcontact.php"
                    onsubmit="return validateContactForm()">
                    <input type="text" name="name" id="name" placeholder="Your Name">
                    <div id="name_error" style="color:red;font-size:11px;"></div>

                    <input type="email" name="email" id="email" placeholder="Your Email">
                    <div id="email_error" style="color:red;font-size:11px;"></div>

                    <input type=" tel" name="phone" id="phone" placeholder="Your Phone">
                    <div id="phone_error" style="color:red;font-size:11px;"></div>

                    <textarea name="message" id="message" placeholder="Your Message"></textarea>
                    <div id="message_error" style="color:red;font-size:11px;"></div>

                    <button type="submit" id="sendMessageBtn" name="sendMessageBtn">Send Message</button>
                </form>
            </div>

            <script>
            function validateContactForm() {
                var isValidName = validateName();
                var isValidEmail = validateEmail();
                var isValidPhone = validatePhone();
                var isValidMessage = validateMessage();

                return isValidName && isValidEmail && isValidPhone && isValidMessage;
            }

            function validateName() {
                var nameInput = document.getElementById("name").value.trim();
                var nameError = document.getElementById("name_error");
                var namePattern = /^[A-Za-z\s]+$/;

                if (nameInput === "") {
                    nameError.innerHTML = "Name cannot be empty.";
                    return false;
                } else if (!namePattern.test(nameInput)) {
                    nameError.innerHTML = "Name must only contain letters and spaces.";
                    return false;
                } else {
                    nameError.innerHTML = "";
                    return true;
                }
            }

            function validateEmail() {
                var emailInput = document.getElementById("email").value.trim();
                var emailError = document.getElementById("email_error");
                var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                if (emailInput === "") {
                    emailError.innerHTML = "Email cannot be empty.";
                    return false;
                } else if (!emailPattern.test(emailInput)) {
                    emailError.innerHTML = "Invalid email format.";
                    return false;
                } else {
                    emailError.innerHTML = "";
                    return true;
                }
            }

            function validatePhone() {
                var phoneInput = document.getElementById("phone").value.trim();
                var phoneError = document.getElementById("phone_error");
                var phonePattern = /^\d{10}$/;

                if (phoneInput === "") {
                    phoneError.innerHTML = "Phone number cannot be empty.";
                    return false;
                } else if (!phonePattern.test(phoneInput)) {
                    phoneError.innerHTML = "Phone number must be 10 digits.";
                    return false;
                } else {
                    phoneError.innerHTML = "";
                    return true;
                }
            }

            function validateMessage() {
                var messageInput = document.getElementById("message").value.trim();
                var messageError = document.getElementById("message_error");

                if (messageInput === "") {
                    messageError.innerHTML = "Message cannot be empty.";
                    return false;
                } else {
                    messageError.innerHTML = "";
                    return true;
                }
            }
            </script>
</body>

</html>


<div id="rightbox">
    <img id="advertis" src="./images/advertisment.webp" alt="">
</div>
</div>
<div id="faqSection">
    <h2>Frequently Asked Questions</h2>

    <div class="faqItem">
        <h3 class="question">1.How do I book a car?</h3>
        <p class="answer">You can book a car by searching your desired car and filling
            out
            the booking form but for that you have to be logged in.</p>
    </div>

    <div class="faqItem">
        <h3 class="question">2.What are the requirements for renting a car?</h3>
        <p class="answer">To rent a car,you must search the car,log in and do downpayment of 15%.</p>
    </div>

    <div class="faqItem">
        <h3 class="question">3.How does the payment process work?</h3>
        <p class="answer">You must pay 15% as advance payment and remaining via cash or online method
            after
            service
            is provided.</p>
    </div>

    <div class="faqItem">
        <h3 class="question">4.Can I cancel my booking?</h3>
        <p class="answer">Yes, you can cancel your booking up to 12 hours of time period but after 12 hours 15%
            payment
            cannot
            be
            refunded> </p>
    </div>

    <div class="faqItem">
        <h3 class="question">5.Are there any additional charges?</h3>
        <p class="answer">Additional charges may not apply but if car met accidents you must solve the
            issue
            before
            returning the car.</p>
    </div>
</div>

<footer>
    <div id="footerbox">

        <div id="footerabout">
            <h3>About Us</h3>
            <p>
                Founded in 2024 by two ambitious students, DrivZy is set to become Nepal's premier
                vehicle
                rental service, providing an exceptional travel experience. With a dedication to
                quality,
                DrivZy
                offers car rentals across Nepal, delivering reliability and affordability.
            </p>
        </div>


        <div id="footerinfo">
            <h3>Contact Info</h3>
            <p> <i class="fas fa-map-marker-alt"></i>Rupandehi,Nepal</p>
            <p><i class="fas fa-phone"></i>9867556559</p>
            <p><i class="fas fa-envelope"></i><a href="mailto:paudelsandhya1588@gmail.com">teamdrivZy@gmail.com
            </p>


        </div>


        <div id="footerlinks">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#blogs">About</a></li>
                <li><a href="#faqSection">FAQs</a></li>
                <li><a href="#contactSection">Contact</a></li>
                <li><a href="./admin/admin.php">Admin</a></li>
                <?php if ($message): ?>
                <div class="message" style="font-family:'Segoe UI Historic', 'Segoe UI', Helvetica, Arial, sans-serif;">

                    <p><?php echo $message; ?></p>
                </div>
                <?php endif; ?>
            </ul>

        </div>

        <div id=" footernetwork">
            <h3>Social Network</h3>
            <div class="socialicons">
                <a href="#" id="fbiconn"><i class="fab fa-facebook"></i>
                </a>
                <a href="#" id="isiconn"> <i class=" fab fa-instagram"></i>
                </a>
                <a href="#" id="linkiconn"> <i class=" fab fa-linkedin"></i>
                </a>
                <a href="#" id="yticonn"> <i class=" fab fa-youtube"></i>
                </a>
            </div>
        </div>


</footer>





<script>
const fbicon = document.getElementById('fbiconn');
fbicon.addEventListener('mouseover', function() {
    fbicon.style.backgroundColor = 'blue';
    fbicon.style.color = 'black';

});



fbicon.addEventListener('mouseout', function() {
    fbicon.style.backgroundColor = '#C45946';
    fbicon.style.color = 'black';
});

const isicon = document.getElementById('isiconn');

isicon.addEventListener('mouseover', function() {
    isicon.style.backgroundColor = '#C13584';
    isicon.style.color = 'black';

});



isicon.addEventListener('mouseout', function() {
    isicon.style.backgroundColor = '#C45946';
    isicon.style.color = 'black';
});

const linkicon = document.getElementById('linkiconn');

linkicon.addEventListener('mouseover', function() {
    linkicon.style.backgroundColor = '#0A66C2';
    linkicon.style.color = 'black';

});

linkicon.addEventListener('mouseout', function() {
    linkicon.style.backgroundColor = '#C45946';
    linkicon.style.color = 'black';
});

const yticon = document.getElementById('yticonn');

yticon.addEventListener('mouseover', function() {
    yticon.style.backgroundColor = '#FF0000';
    yticon.style.color = 'black';

});

yticon.addEventListener('mouseout', function() {
    yticon.style.backgroundColor = '#C45946';
    yticon.style.color = 'black';
});




document.querySelectorAll(".question").forEach(question => {
    question.addEventListener("click", () => {
        const faqItem = question.parentElement;
        faqItem.classList.toggle("active");

        const answer = faqItem.querySelector(".answer");
        answer.style.display = answer.style.display === "block" ? "none" : "block";
    });
});
</script>
</body>

</html>