<?php
    include ('./config.php');
    include 'assets/includes/db_connect.php';
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
    <title><?php echo WEBSITE_NAME; ?> | Tours</title>

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

<body id = "toursPage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero starts -->
    <section id="hero">
        <img src="assets/images/tour-hero.jpg" alt="Explore Vacations - Tours">
        <div class="hero-content">
            <h1>Tours</h1>
        </div>
    </section>
    <!-- Hero ends -->

    <!-- Tour Theme section starts -->
    <section id="tour-theme" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="heading text-center">Discover Our Tour Themes</h2>
                    <p class="supportive-text text-center"> Explore a curated collection of unique travel experiences across Sri Lanka. Whether you seek adventure, culture, wildlife, or relaxation, our tour themes help you find the perfect journey tailored to your interests.</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                        $query = "SELECT * FROM tour_themes";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($themes) > 0) {
                            echo '<div class="row g-4 mt-4">';

                            foreach ($themes as $row) {

                                $images = json_decode($row['theme_images'], true);

                                if (!$images || count($images) === 0) {
                                    $firstImage = 'assets/images/default-theme.jpg'; 
                                } else {
                                    $firstImage = 'assets/' . ltrim($images[0], '/');
                                }

                                echo '
                                    <div class="col-md-4 col-lg-3 mt-md-0">
                                        <div class="card h-100 shadow-sm">
                                            <img src="' . $firstImage . '" class="card-img-top" alt="' . htmlspecialchars($row['theme_name']) . '">
                                            <div class="card-body text-center">
                                                <h3 class="card-title">' . htmlspecialchars($row['theme_name']) . '</h5>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }

                            echo '</div>';
                        } else {
                            echo "<p class='text-center mt-4'>No tour themes found.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Tour Theme section ends -->


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