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
    <title><?php echo WEBSITE_NAME; ?></title>

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

<body id = "homePage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Home hero starts -->
    <section id="homeHero">
        <!-- Swiper Container -->
        <div class="swiper homeHeroSwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="assets/images/home-hero/img-1.jpg" alt="Explore Vacations"class="img-fluid d-none d-md-block">
                    <img src="assets/images/home-hero/img-1-sm.jpg" alt="Explore Vacations" class="img-fluid d-md-none">
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="assets/images/home-hero/img-2.jpg" alt="Explore Vacations" class="img-fluid d-none d-md-block">
                    <img src="assets/images/home-hero/img-2-sm.jpg" alt="Explore Vacations" class="img-fluid d-md-none">
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="assets/images/home-hero/img-3.jpg" alt="Explore Vacations" class="img-fluid d-none d-md-block">
                    <img src="assets/images/home-hero/img-3-sm.jpg" alt="Explore Vacations" class="img-fluid d-md-none">
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="homehero-content">
            <h1 data-aos="fade-down-right" data-aos-duration="1000">
                Discover Wonders<br class="d-md-none"> with<br class="d-none d-md-block"> Every Step
            </h1>

            <p class="mt-3" data-aos="fade-down-left" data-aos-duration="1000">
                Sri Lanka is not just an island, it's a life <br class="d-md-none">changing experience!
                <br>Embark on an unforgettable journey through
                <br class="d-md-none">Sri Lanka's enchanting <br class="d-none d-md-block">landscapes.
            </p>

            <a href="./contact" class="mt-3">Contact Us</a>
        </div>
    </section>
    <!-- Home hero ends -->

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
<script>
    const heroSwiper = new Swiper(".homeHeroSwiper", {
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        speed: 800,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        }
    });
</script>

    
</body>
</html>