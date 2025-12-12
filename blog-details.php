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
    <title><?php echo WEBSITE_NAME; ?> | Blog Details</title>

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

<body id = "blogDetailPage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero starts -->
    <section id="hero">
        <img src="assets/images/blog-detail-hero.jpg" alt="Explore Vacations - Blog Details">
        <div class="hero-content">
            <h1>Blog Details</h1>
        </div>
    </section>
    <!-- Hero ends -->

    <!-- Blog Details Section Starts -->
    <section id="blog-details" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <img src="assets/images/blogs/detail-img.jpg" class="img-fluid rounded" alt="Blog Featured Image">
                    </div>

                    <!-- Title & Meta -->
                    <h2 class="fw-bold mb-3">Exploring the Beauty of Sri Lanka</h2>
                    <div class="text-muted mb-4">
                        <span class="me-3"><i class="fa-regular fa-user"></i> Admin</span>
                        <span class="me-3"><i class="fa-regular fa-calendar"></i> December 12, 2025</span>
                        <span><i class="fa-solid fa-tag"></i> Travel, Sri Lanka</span>
                    </div>

                    <!-- Blog Body -->
                    <p>
                        Sri Lanka is one of the most breathtaking islands in the world, rich with culture,
                        wildlife, and unforgettable landscapes. From golden beaches to misty mountains, the
                        island offers a diverse range of experiences for travelers.
                    </p>

                    <p>
                        Whether you’re exploring ancient temples in Anuradhapura, hiking through the lush
                        tea plantations of Ella, or watching the sunset in Galle Fort, each destination
                        tells a story of heritage and natural beauty.
                    </p>

                    <!-- Highlighted Quote -->
                    <blockquote class="blockquote border-start ps-3 my-4">
                        “Sri Lanka is an island that everyone loves at some level inside themselves.”
                    </blockquote>

                    <p>
                        The island’s hospitality is unmatched. Locals warmly welcome visitors and share
                        their love for traditional food, festivals, and cultural values. Combined with
                        world-class hotels and scenic train rides, Sri Lanka should be on every traveler’s list.
                    </p>

                    <!-- Tags -->
                    <div class="mt-4">
                        <strong>Tags:</strong>
                        <a href="#" class="badge bg-secondary text-decoration-none">Sri Lanka</a>
                        <a href="#" class="badge bg-secondary text-decoration-none">Travel</a>
                        <a href="#" class="badge bg-secondary text-decoration-none">Culture</a>
                    </div>

                    <!-- Social Share -->
                    <div class="mt-4">
                        <strong>Share:</strong>
                        <a href="#" class="text-muted ms-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-muted ms-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-muted ms-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-muted ms-3"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card p-3 shadow-sm mb-4">
                        <h5 class="mb-3">Search</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search blogs...">
                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="card p-3 shadow-sm mb-4">
                        <h5 class="mb-3">Recent Posts</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="#" class="text-decoration-none">Top 10 Beaches in Sri Lanka</a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="text-decoration-none">Why Ella Is a Must-Visit</a>
                            </li>
                            <li>
                                <a href="#" class="text-decoration-none">Wildlife Adventures in Yala</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card p-3 shadow-sm">
                        <h5 class="mb-3">Categories</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none">Travel</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Culture</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none">Adventure</a></li>
                            <li><a href="#" class="text-decoration-none">Food</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Related Posts -->
            <div class="mt-4 related-posts">
                <h3 class="fw-bold mb-4">Related Blogs</h3>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/1.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">A Guide to Galle Fort</h5>
                                <p class="card-text">Explore the historic streets, cafes and coastlines.</p>
                                <a href="#" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/2.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Hiking in Ella</h5>
                                <p class="card-text">Scenic mountains and peaceful tea estates.</p>
                                <a href="#" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/blogs/3.jpg" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Sri Lankan Cuisine</h5>
                                <p class="card-text">A journey through authentic island flavors.</p>
                                <a href="#" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section Ends -->


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