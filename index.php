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
            <h1 data-aos="fade-down-right" data-aos-duration="1000">Discover Wonders<br class="d-md-none"> with<br class="d-none d-md-block"> Every Step</h1>
            <p class="mt-3" data-aos="fade-down-left" data-aos-duration="1000">Discover unforgettable journeys with Explore Vacations. <br>Adventure, relaxation, and memories that last a lifetime.</p>
            <a href="./contact" class="mt-3">Contact Us</a>
        </div>
    </section>
    <!-- Home hero ends -->

    <!-- Why choose us section starts -->
     <section id="why-choose-us" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="card">
                        <div class="card-body" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="heading mb-4">Why Choose Us?</h2>
                            <p class="supportive-text">At Explore Vacations, we are passionate about creating unforgettable travel experiences. Here’s why you should choose us for your next adventure:</p> 
                            <ul class="list-unstyled">
                                <li><img src="assets/images/icons/map-marked.svg" class="img-fluid" alt="map-marked"> <p><b>Personalized Itineraries :</b> We tailor each trip to your preferences, ensuring a unique and memorable experience.</p></li>
                                <li><img src="assets/images/icons/user-tie.svg" class="img-fluid" alt="user-tie"> <p><b>Expert Guides :</b> Our knowledgeable guides provide insights and local expertise to enrich your journey.</p></li>
                                <li><img src="assets/images/icons/headset.svg" class="img-fluid" alt="headset"> <p><b>24/7 Support :</b> We are available around the clock to assist you during your travels.</p></li>
                                <li><img src="assets/images/icons/dollar-sign.svg" class="img-fluid" alt="dollar-sign"> <p><b>Best Price Guarantee :</b> We offer competitive pricing without compromise.</p></li>
                                <li><img src="assets/images/icons/leaf.svg" class="img-fluid" alt="leaf"> <p><b>Commitment to Sustainability :</b> We prioritize eco-friendly practices to preserve the beauty of our destinations.</p></li>
                            </ul>
                        </div> 
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex align-items-center mt-3 mt-md-0" data-aos="fade-left" data-aos-duration="1000">
                    <img src="assets/images/why-choose-us-img.jpg" alt="Why Choose Us" class="img-fluid why-choose-us-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Service Counter section starts -->
    <section id="service-counter" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="service-counter-wrapper d-flex flex-column flex-md-row justify-content-around align-items-center">
                        <div class="counter-item text-center" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="counter-number">500+</h2>
                            <p class="counter-label">Happy Travellders</p>
                        </div>
                        <div class="counter-item text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <h2 class="counter-number">150+</h2>
                            <p class="counter-label">Destinations Covered</p>
                        </div>
                        <div class="counter-item text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <h2 class="counter-number">50+</h2>
                            <p class="counter-label">Expert Guides</p>
                        </div>
                        <div class="mb-0 counter-item text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                            <h2 class="counter-number">24/7</h2>
                            <p class="counter-label">Customer Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Counter section ends -->

    <!-- Trending Destinations section starts -->
     <section id="trending-destinations" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="heading text-center">Trending Destinations</h2>
                </div>
            </div>
            <div class="swiper myDestinationsSwiper mt-3">
                <div class="swiper-wrapper" data-aos="zoom-in" data-aos-duration="1000">

                    <!-- Sigiriya -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/1.jpg" alt="Sigiriya" class="img-fluid">
                            <h3 class="destination-name mt-2">Sigiriya</h3>
                        </div>
                    </div>

                    <!-- Kandy -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/2.jpg" alt="Kandy" class="img-fluid">
                            <h3 class="destination-name mt-2">Kandy</h3>
                        </div>
                    </div>

                    <!-- Mirissa -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/3.jpg" alt="Mirissa" class="img-fluid">
                            <h3 class="destination-name mt-2">Mirissa</h3>
                        </div>
                    </div>

                    <!-- Jaffna -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/4.jpg" alt="Jaffna" class="img-fluid">
                            <h3 class="destination-name mt-2">Jaffna</h3>
                        </div>
                    </div>

                    <!-- Galle -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/5.jpg" alt="Galle" class="img-fluid">
                            <h3 class="destination-name mt-2">Galle</h3>
                        </div>
                    </div>

                    <!-- Ella -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/6.jpg" alt="Ella" class="img-fluid">
                            <h3 class="destination-name mt-2">Ella</h3>
                        </div>
                    </div>

                    <!-- Nuwara Eliya -->
                    <div class="swiper-slide">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/7.jpg" alt="Nuwara Eliya" class="img-fluid">
                            <h3 class="destination-name mt-2">Nuwara Eliya</h3>
                        </div>
                    </div>

                    <!-- Trincomalee -->
                    <div class="swiper-slide mb-4">
                        <div class="destination-item text-center">
                            <img src="assets/images/trending-destinations/8.jpg" alt="Trincomalee" class="img-fluid">
                            <h3 class="destination-name mt-2">Trincomalee</h3>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- Trending Destinations section ends -->

    <!-- Beauty of Srilanka section starts -->
    <section id="beauty-of-srilanka" class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col px-0">
                    <div class="image-overlay">
                        <img src="assets/images/beauty-srilanka.png" alt="Beauty of Srilanka" class="img-fluid w-100">
                        <div class="overlay"></div> 
                        <div class="overlay-text">
                            <h2 class="heading">Journey Through Sri Lanka</h2>
                            <a href="#" class="btn btn-primary mt-3">Explore More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Beauty of Srilanka section ends -->


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

    <script>
        var swiper = new Swiper(".myDestinationsSwiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,

            autoplay: {
                delay: 2000,     
                disableOnInteraction: false,
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                576: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                992: { slidesPerView: 6 },
            }
        });
    </script>
</body>
</html>