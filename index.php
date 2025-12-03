<?php
include ('./config.php');
include ('./classes/EmailSender.php');

$errors = [];
$required_vehicles = [];
$tour_start_date = $tour_end_date = $name = $email = $phone = $message = "";
$recaptcha_response = "";

//checking whether the user submits the form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $tour_start_date = test_input($_POST['tour_start_date']);
    $tour_end_date = test_input($_POST['tour_end_date']);
    if (isset($_POST['required_vehicles']) && is_array($_POST['required_vehicles'])) {
        $required_vehicles = $_POST['required_vehicles'];
        $required_vehicles = implode(',', $required_vehicles);
    } else {
        $required_vehicles = "N/A";
    }
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $message = test_input($_POST['message']);
    $recaptcha_response = filter_input(INPUT_POST, 'recaptchaResponse');

    // Verify reCAPTCHA
    if (!verifyRecaptcha($recaptcha_response)) {
        $errors['recaptcha'] = "reCAPTCHA validation failed.";
    }

    // Validate start date
    if (empty($_POST['tour_start_date'])) {
        $errors['tour_start_date'] = "Start date is required";
    } elseif (!empty($_POST['tour_end_date'])) {
    }

    // Validate end date
    if (empty($_POST['tour_end_date'])) {
        $errors['tour_end_date'] = "End date is required";
    } else {
        $start_date_timestamp = strtotime($tour_start_date);
        $end_date_timestamp = strtotime($tour_end_date);

        if ($start_date_timestamp > $end_date_timestamp) {
            $errors['tour_end_date'] = "End date must be after or equal to the start date";
        }
    }

    // Validate names
    if (empty($name)) {
        $errors['name'] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors['name'] = "Name should be at least 3 characters long";
    } elseif (strlen($name) > 50) {
        $errors['name'] = "Name should not exceed 50 characters";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Enter a valid email address";
    }

    // Validate phone number
    if (empty($phone)) {
        $errors['phone'] = "Contact number is required";
    } elseif (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
        $errors['phone'] = "Enter a valid contact number";
    }

    if (empty($errors)) {
        $emailSender = new EmailSender();

        $emailTo = 'sachin.pixzarloop@gmail.com';
        $emailSubject = 'Booking Vehicles';
        $emailContent = "<table>
                            <tr>
                                <td><b>Start Date</b></td>
                                <td> : $tour_start_date</td>
                            </tr>
                            <tr>
                                <td><b>End Date</b></td>
                                <td> : $tour_end_date</td>
                            </tr>
                            <tr>
                                <td><b>Required Vehicles</b></td>
                                <td> : $required_vehicles</td>
                            </tr>
                            <tr>
                                <td><b>Name</b></td>
                                <td> : $name</td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td> : $email</td>
                            </tr>
                            <tr>
                                <td><b>Phone</b></td>
                                <td> : $phone</td>
                            </tr>
                            <tr>
                                <td><b>Message</b></td>
                                <td> : $message</td>
                            </tr>
                        </table>";

        $result = $emailSender->sendEmail($emailTo, $emailSubject, $emailContent);

        // Check the result of sending the email
        if ($result === true) {
            $successMessage = 'Your message has been sent successfully!';
            // Clear the form fields after successful submission
            $tour_start_date = $tour_end_date = $required_vehicles = $name = $email = $phone = $message = "";
        } else {
            $errorMessage = 'Sorry, there was an issue sending your message. Please try again.';
        }

    } else {
        echo "<script>window.onload = () => document.getElementById('booking').scrollIntoView({ behavior: 'smooth' });</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo WEBSITE_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo WEBSITE_KEYWORDS; ?>">
    <meta name="author" content="Pixzarloop">
    <meta name="robots" content="index, follow">

    <!-- Page Title -->
    <title><?php echo WEBSITE_NAME; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

    <!-- Canonical URL -->
    <link rel="canonical" href="">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Swiper JS -->
    <link rel="stylesheet" href="node_modules/swiper/swiper-bundle.min.css">
    <!-- AOS Animations CSS -->
    <link href="node_modules/aos/dist/aos.css" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/overrides.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body id = "homePage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Home hero starts -->
    <section id="homeHero">
        <img src="assets/images/home-hero.webp" alt="Ceylon Adventure Tours">
        <div class="homehero-content">
            <h1 data-aos="fade-down-right" data-aos-duration="1000">Discover Wonders<br class="d-md-none"> with<br class="d-none d-md-block"> Every Step</h1>
            <p class="mt-3" data-aos="fade-down-left" data-aos-duration="1000">Sri Lanka is not just an island, it's a life <br class="d-md-none">changing experience! <br>Embark on an unforgettable journey through <br class="d-md-none">Sri Lanka's enchanting <br class="d-none d-md-block">landscapes.</p>
            <a href="./contact" class="mt-3">Contact Us</a>
        </div>
    </section>
    <!-- Home hero ends -->

    <!-- Welcome section starts -->
    <section id="welcome">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 p-0">
                    <div class="welcome-intro">         
                        <h2 data-aos="fade-up">Rent For Your Adventures</h2>
                        <p data-aos="fade-right" data-aos-delay="100">Ceylon Adventure Tours stands out as one of the premier travel agencies in Sri Lanka, offering unparalleled experiences for adventurers.</p>
                    </div>
                    </div>
                <div class="col-12 col-md-6 p-0">
                    <div class="welcome-details">
                        <ul>
                            <li>
                                <span data-aos="fade-up">
                                    <img src="./assets/images/icons/hero-cup-star-bold.svg" alt="Icons">
                                    <h3>20 years of experience</h3>
                                </span>
                                <p data-aos="fade-up" data-aos-delay="100">We have experience in providing unforgettable services to the visitors of Sri Lanka for more than 20 years</p>
                            </li>
                            <li>
                                <span data-aos="fade-up" data-aos-delay="200">
                                    <img src="./assets/images/icons/hero-cup-star-bold.svg" alt="Icons">
                                    <h3>Quality Service</h3>
                                </span>
                                <p data-aos="fade-up" data-aos-delay="300">We deliver exceptional services and posses an intimate understanding of our customers' holiday aspirations</p>
                            </li>
                            <li>
                                <span data-aos="fade-up" data-aos-delay="300">
                                    <img src="./assets/images/icons/hero-cup-star-bold.svg" alt="Icons">
                                    <h3>Reasonable Price</h3>
                                </span>
                                <p data-aos="fade-up" data-aos-delay="400">We deliver an unparalleled tour package with excellence and affordability, ensuring you get the best value for your money</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome section ends -->

    <!-- Booking section starts -->
    <section id="booking" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="supportive-text" data-aos="fade-down">Need A Ride?</p>
                    <h2 class="mb-3" data-aos="fade-up">Start <span>Booking</span></h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 order-lg-4">
                    <img src="assets/images/image.webp" alt="Ceylon Adventure Tours - Booking" class="img-fluid">
                </div>
                 <div class="col-12 col-lg-7">
                    <p class="py-3">Need to select a preferred vehicle? <a href="tours.php#ourFleet"> Check our fleet here</a></p>
                    <form action="./" method="POST" data-aos="fade-right">
                        <div class="row">
                            <div class="col-12 col-md-12">
                            <?php if (isset($successMessage)): ?>
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <?= $successMessage ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php elseif (isset($errorMessage)): ?>
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        <?= $errorMessage ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tourStartDate" class="form-label">Start Date<span class="text-danger">*</span></label>
                                <input type="date" name="tour_start_date" id="tourStartDate" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $tour_start_date; ?>">
                                <?php if (!empty($errors['tour_start_date'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['tour_start_date']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3 ">
                                <label for="tourEndDate" class="form-label">End Date<span class="text-danger">*</span></label>
                                <input type="date" name="tour_end_date" id="tourEndDate" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $tour_end_date; ?>">
                                <?php if (!empty($errors['tour_end_date'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['tour_end_date']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 my-3">
                                <label for="requiredVehicles" class="form-label">Select required vehicles</label>
                                <div id="requiredVehicles">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_1" value="Honda XR 230cc">
                                        <label class="form-check-label" for="vehicle_1">Honda XR 230cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_2" value="Honda XR Baja 250cc">
                                        <label class="form-check-label" for="vehicle_2">Honda XR Baja 250cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_3" value="Royal Enfield 350cc">
                                        <label class="form-check-label" for="vehicle_3">Royal Enfield 350cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_4" value="Honda CRF 250cc">
                                        <label class="form-check-label" for="vehicle_4">Honda CRF 250cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_5" value="Honda XR 125cc">
                                        <label class="form-check-label" for="vehicle_5">Honda XR 125cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_6" value="Suzuki Burgman 125cc">
                                        <label class="form-check-label" for="vehicle_6">Suzuki Burgman 125cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_7" value="Honda PCX 150cc">
                                        <label class="form-check-label" for="vehicle_7">Honda PCX 150cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_8" value="Honda FZ 150cc">
                                        <label class="form-check-label" for="vehicle_8">Honda FZ 150cc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_9" value="Bajaj Three Wheeler">
                                        <label class="form-check-label" for="vehicle_9">Bajaj Three Wheeler</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required_vehicles[]" id="vehicle_10" value="Honda Shuttle">
                                        <label class="form-check-label" for="vehicle_10">Honda Shuttle</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter your full name" value="<?= $name; ?>">
                                <?php if (!empty($errors['name'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['name']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email address" value="<?= $email; ?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['email']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your contact number" value="<?= $phone; ?>">
                                <?php if (!empty($errors['phone'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['phone']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="5"
                                    placeholder="Enter your message here"><?= $message; ?></textarea>
                            </div>
                            <input type="hidden" name="recaptchaResponse" id="recaptchaResponse">
                            <div class="col-12">
                                <input class="form-submit" type="submit" name="submit" value="Request Booking">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Booking section ends -->

    <!-- Get license section starts -->
    <section id="getLicense" class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="supportive-text" data-aos="fade-down">License</p>
                    <h2 class="heading mb-3" data-aos="fade-down">Get Your <span>License</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p data-aos="fade-up">It is mandatory for you to get your non-Sri Lankan license verified in Sri Lanka. To save your precious time we are determined to help you in arranging your temporary driving license beforehand. It doesn’t matter where you are. Just by providing us your address, we can deliver your verified license to your doorstop.</p>
                    <a href="./apply-license" class="mt-3">Apply For License</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Get license section starts -->

    <!-- Service section starts -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="supportive-text" data-aos="fade-down">What we offer</h>
                    <h2 class="mb-3" data-aos="fade-up">Wide range of <span>Services</span></h2>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-1 pt-4 mx-auto gy-5 gx-md-5">
                <div class="col" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card service-card">
                        <div class="card-head">
                            <img class="card-img-top" src="assets/images/services/service-1.webp" alt="A-bike">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Motorcycle Tours & Rents</h3>
                            <p class="justify-text">Motorcycle tours and rental of motorbikes are available from us and they can be arranged with us prior to your arrival.</p>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card service-card">
                        <div class="card-head">
                            <img class="card-img-top" src="assets/images/services/service-2.webp" alt="A jeep">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Jeep Tours</h3>
                            <p class="justify-text">Our Jeep tours are the perfect addition to any experience, giving a touch of adventure and loads of local culture to your Sri Lankan stay.</p>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card service-card">
                        <div class="card-head">
                            <img class="card-img-top" src="assets/images/services/service-3.webp" alt="A van">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Vehicle Tours & Rents</h3>
                            <p class="justify-text">Vehicle tours that are tailor made for to suit you and your family is available from us. These tours can be made with A/C car, mini coach.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service section ends -->

    <!-- Special section starts -->
    <section id="specials" class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="supportive-text" data-aos="fade-down">What's Special</p>
                    <h2 data-aos="fade-up">Our Unique <span>Services</span></h2>
                </div>
            </div>
            <div class="row row-col-1 row-cols-md-2 row-cols-lg-3 py-4 mx-auto gy-4">
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up">
                        <img src="assets/images/specials/specials-1.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">Handover & Pickup</h3>
                            <p>We hand over and Pickup bikes from your door step where you are in Sri Lanka</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up" data-aos-delay="100">
                        <img src="assets/images/specials/specials-2.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">Experienced Mechanics</h3>
                            <p>We provide well experienced mechanics to your tour when you get guided tour packages</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up" data-aos-delay="200">
                        <img src="assets/images/specials/specials-3.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">Airport Shuttle</h3>
                            <p>We offer airport drop-off and pickup services 24 hours a day, if required</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up" data-aos-delay="300">
                        <img src="assets/images/specials/specials-4.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">Driver Permit</h3>
                            <p>We assist you in getting driver permit before you arrive Sri Lanka. <a href="./apply-license"><span>Check here</span></a> for more information</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up" data-aos-delay="400">
                        <img src="assets/images/specials/specials-5.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">24 x 7 Service</h3>
                            <p>We provide break down assistance and Motorcycle replacement island wide 24 hours in the day.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card specials-card" data-aos="slide-up" data-aos-delay="500">
                        <img src="assets/images/specials/specials-6.webp" alt="Ceylon Adventure Tours - Specials Image">
                        <div class="card-body">
                            <h3 class="card-title">Other Services</h3>
                            <p>We provide road maps, Helmets, Bungee Cords, Phone Holder, Luggage Carriers according to your requirement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special section ends -->

    <!-- Team section ends -->
    <section id="team" class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 team-left-section">
                    <h2>Meet Our<br> Expert Team</h2>
                    <p class="justify-text">Our experienced team is committed to ensuring your tour is a seamless and successful experience. Let our passion for travel and meticulous planning elevate your journey to new heights.</p>
                </div>
                <div class="col-12 col-md-6 team-right-section" data-aos="fade-left">
                    <div class="swiper specials">
                        <div class=" swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="assets/images/team/team-1.webp" alt="carousel-team" />
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/images/team/team-2.webp" alt="carousel-team" />
                            </div>
                            <div class="swiper-slide">
                                <img src="assets/images/team/team-3.webp" alt="carousel-team" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team section ends -->

    <!-- Testimonials section starts -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="supportive-text" data-aos="fade-down">Experiences</p>
                    <h2 class="heading mb-3" data-aos="fade-down">What Customers <span>Say</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-center" data-aos="fade-up">Discover what our valued clients have to say about their extraordinary experiences with us. Real stories, real adventures, real satisfaction.</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-8 justify-content-center" data-aos="fade-up">
                <div class="col">
                    <div class="swiper testimonials">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="https://maps.app.goo.gl/g6Zw7nwBT8d2Ac3w6" target="_blank">
                                        <div class="card-body">
                                            <p class="text-center">Had the pleasure to rent a 350 classic for a few days to get out and explore. The bike, roads and views were exceptional. If you’re an experienced rider and looking for an epic experience, do yourself a favour and get out on a bike from these guys!</p>
                                        </div>
                                        <div class="card-footer">
                                            <p>Luke Scott</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="https://maps.app.goo.gl/A9nEav7xNP3s3Ygw9" target="_blank">
                                        <div class="card-body">
                                            <p class="text-center">Hired Yamaha FZ (150) manual bike for the day. Perfect for cruising around the beautiful Ella countryside. Very professional service from the shop, would definitely recommend or use again</p>
                                        </div>
                                        <div class="card-footer">
                                            <p>Scott Griffiths</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="https://maps.app.goo.gl/8mQB8EjeBb2vqeKC9" target="_blank">
                                        <div class="card-body">
                                            <p class="text-center">So far so good, great bike to enjoy the beautiful Sri Lanka, worker are great and efficiency , they do everything to help and make you have a great time.</p>
                                        </div>
                                        <div class="card-footer">
                                            <p>Simon Says</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card">
                                    <a href="https://maps.app.goo.gl/DHZMUYdTuSaWX8Hm9" target="_blank">
                                        <div class="card-body">
                                            <p class="text-center">Had an amazing time riding with the guys at Ceylon around Ella during a recent trip to Sri Lanka. We rode to the top of Lipton seat and various waterfalls on the way back. Definitely one of the highlights of the holiday. Highly recommend.</p>
                                        </div>
                                        <div class="card-footer">
                                            <p>Luke Pavone</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials section starts -->

    <!-- Memories section starts -->
    <section id="memories" class="pt-5">
        <div class="memories-container pt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="supportive-text" data-aos="fade-down">Featured Work</p>
                        <h2 class="mb-4" data-aos="fade-up">Unforgettable <span>Memories</span></h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mx-auto">
                    <div class="col" data-aos="flip-down">
                        <img src="assets/images/memories/memories-1.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="100">
                        <img src="assets/images/memories/memories-2.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="200">
                        <img src="assets/images/memories/memories-3.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="300">
                        <img src="assets/images/memories/memories-4.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="400">
                        <img src="assets/images/memories/memories-5.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="500">
                        <img src="assets/images/memories/memories-6.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="600">
                        <img src="assets/images/memories/memories-7.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                    <div class="col" data-aos="flip-down" data-aos-delay="700">
                        <img src="assets/images/memories/memories-8.webp" alt="Ceylon Adventure Tours - Memories Image" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <div class="container points-container">
            <div class="row pt-4">
                <div class="col-12 col-lg-6 img-container order-lg-2 pt-2 mx-auto justify-content-center justify-content-lg-end" data-aos="fade-left">
                    <img src="assets/images/points-section-bike.webp" alt="A bike">
                </div>
                <div class="col-12 col-lg-6 facts-container pt-3" data-aos="fade-right">
                    <ul class="list-unstyled">
                        <li>
                            <span>
                                <img src="assets/images/icons/points-1.svg" alt="Ceylon Adventure Tours | Check Icon">
                                Quality & Safety
                            </span>
                            <p class="justify-text mt-2 mb-4">Our safety is our top priority. We ensure the highest standards of quality and safety throughout your entire journey.</p>
                        </li>
                        <li>
                            <span>
                                <img src="assets/images/icons/points-2.svg" alt="Ceylon Adventure Tours | Check Icon">
                                Exceptional Motorcycle tours
                            </span>
                            <p class="justify-text mt-2 mb-4">Experience the thrill of the open road with our expertly crafted motorcycle tours for unforgettable adventures. <span><a href="./tours">View More.</a></span></p>
                        </li>
                        <li>
                            <span>
                                <img src="assets/images/icons/points-3.svg" alt="Ceylon Adventure Tours | Check Icon">
                                Traveler's Trust & Ratings
                            </span>
                            <p class="justify-text mt-2 mb-4">Hear what our satisfied travelers have to say about their experiences with us, and discover why we're trusted by adventurers worldwide. <span><a href="#testimonials">View More.</a></span></p>
                        </li>
                        <li>
                            <span>
                                <img src="assets/images/icons/points-4.svg" alt="Ceylon Adventure Tours | Check Icon">
                                Get Your license
                            </span>
                            <p class="justify-text mt-2">To save your precious time we are determined to help you in arranging your temporary driving license beforehand <span><a href="./apply-license">View More.</a></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Memories section ends -->

    <!-- FAQ starts -->
    <section id="faq" class="pt-4 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 p-3">
                    <p class="supportive-text" data-aos="fade-down">Answers Await</p>
                    <h2 class="mb-0" data-aos="fade-up">Frequently Asked <span>Questions</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                    Can I use my own driving license?
                                </button>
                            </h4>
                            <div id="faq1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Yes. You can use your own driving license but you need to get your license verified in Sri Lanka. We can get your license verified on behalf of you. Verify your license from <a href="./apply-license">here</a>.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    How can I apply for a driving license?
                                </button>
                            </h4>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    You can apply for a temporary driving license via us. You can pick it up from one of our branch or we can deliver the license to your doorstep. Apply from <a href="./apply-license">here</a>.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    How much does it cost and how long will it take to receive the license?
                                </button>
                            </h4>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    You need to pay only 56 USD to verify your license and it will take only 2-3 business days.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    Do I need to keep a deposit to rent a motorcycle?
                                </button>
                            </h4>
                            <div id="faq4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    Yes. You need to keep a deposit of 200 USD or any currency which is equivalent to that value or you can conveniently keep your passport. The deposit will be returned in the same currency at the end of your journey.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="true" aria-controls="faq5">
                                    What documents do I need to submit to get my license?
                                </button>
                            </h4>
                            <div id="faq5" class="accordion-collapse collapse show" aria-labelledby="heading5" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">
                                    You need to provide the images of front & back side of your driving license and a photo of yourself.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ ends -->

    <!-- Footer starts -->
    <?php include 'parts/footer.php'; ?>
    <!-- Footer ends -->

    <!-- Bootstrap -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Swiper JS -->
    <script src="node_modules/swiper/swiper-bundle.min.js"></script>
    <!-- AOS Animations JS -->
    <script src="node_modules/aos/dist/aos.js"></script>
    <!-- Whatsapp widget JS -->
    <script src="assets/js/whatsapp-widget.js"></script>
    <!-- Google reCAPTCHA for form verification -->
    <script async src="https://www.google.com/recaptcha/api.js?render=<?php echo GOOGLE_RECAPTCHA_SITE_KEY; ?>"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
    <script>
        window.onload = function() {
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo GOOGLE_RECAPTCHA_SITE_KEY; ?>', {action: 'submit'}).then(function(token) {
                    document.getElementById('recaptchaResponse').value = token;
                });
            });
        };
    </script>
    <script>
        // Team photo swiper
        var swiper = new Swiper(".specials", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        // Testimonial carousel
        var swiper = new Swiper(".testimonials", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    
</body>
</html>