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
    <title><?php echo WEBSITE_NAME; ?> | Blogs</title>

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

<body id = "blogPage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero starts -->
    <section id="hero">
        <img src="assets/images/blog-hero.jpg" alt="Explore Vacations - BLOGS">
        <div class="hero-content">
            <h1>BLOGS</h1>
        </div>
    </section>
    <!-- Hero ends -->

    <!-- Blogs section starts -->
    <section id="blogs" class="py-5">
        <div class="container">
            <div class="col">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/1.jpg" class="card-img-top" alt="Sri Lanka Beaches">
                            <div class="card-body">
                                <h2 class="card-title">Exploring Sri Lanka’s Beaches</h2>
                                <p class="card-text">
                                    Discover the breathtaking coastline of Sri Lanka, from Mirissa to Trincomalee.
                                </p>
                                <a href="./blog-details" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Card 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/2.jpg" class="card-img-top" alt="Sri Lankan Culture">
                            <div class="card-body">
                                <h2 class="card-title">The Rich Culture of Sri Lanka</h2>
                                <p class="card-text">
                                    A look into traditional dances, festivals, and heritage sites across the island.
                                </p>
                                <a href="./blog-details" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Card 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/3.jpg" class="card-img-top" alt="Ella Sri Lanka">
                            <div class="card-body">
                                <h2 class="card-title">Adventure in Ella</h2>
                                <p class="card-text">
                                    Hike through tea plantations, waterfalls, and stunning viewpoints in Ella.
                                </p>
                                <a href="./blog-details" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blogs section ends -->

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