<?php
    include ('./config.php');
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
    <meta name="author" content="Explore Vacations">
    <meta name="robots" content="index, follow">

    <!-- Page Title -->
    <title><?php echo WEBSITE_NAME; ?> | About Us</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

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

<body id = "aboutPage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero starts -->
    <section id="hero">
        <img src="assets/images/about-hero.jpg" alt="Explore Vacations - About Us">
        <div class="hero-content">
            <h1>About Us</h1>
        </div>
    </section>
    <!-- Hero ends -->

    <!-- Intro section starts -->
    <section id="intro-section" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>
                        "Explore Vacations is dedicated to creating unforgettable travel experiences across Sri Lanka. We design personalized tours that match your interests, pace, and budget. From stunning beaches and lush tea plantations to ancient heritage sites and wildlife safaris, we carefully plan every detail of your journey. Our friendly and experienced team ensures comfortable transport, trusted accommodation, and 24/7 support, so you can relax and enjoy a smooth, memorable, and truly authentic Sri Lankan adventure."
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Intro section ends -->

    <!-- Vision mission section starts -->
    <section id="vission-mission" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="mb-4">
                        <h2 class="heading">Our Vision</h2>
                        <p>To be the leading travel company in Sri Lanka, recognized globally for creating meaningful and memorable journeys. We aim to inspire travelers by showcasing Sri Lanka’s rich culture, breathtaking landscapes, and warm hospitality, while delivering world-class, personalized travel experiences that leave a lasting impression.</p>
                    </div>

                    <div>
                        <h2 class="heading">Our Mission</h2>
                        <p>To deliver unforgettable travel experiences by providing personalized travel solutions, reliable customer support, and thoughtfully curated journeys that ensure comfort, safety, and complete customer satisfaction.</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5">
                    <div id="aboutImageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/images/about-us.jpg" class="img-fluid rounded" alt="About Us 1">
                            </div>

                            <div class="carousel-item">
                                <img src="assets/images/about-us-2.jpg" class="img-fluid rounded" alt="About Us 2">
                            </div>

                            <div class="carousel-item">
                                <img src="assets/images/about-us-3.jpg" class="img-fluid rounded" alt="About Us 3">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vision mission section ends -->


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
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>

</html>