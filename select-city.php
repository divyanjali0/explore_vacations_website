<?php
    include ('./config.php');
    include 'assets/includes/db_connect.php';

    // Get selected theme IDs from URL
    $themeIDs = isset($_GET['themes']) ? $_GET['themes'] : '';
    $themeIDsArray = array_filter(explode(",", $themeIDs));

    $themesData = [];
    $allImages = [];

    if (!empty($themeIDsArray)) {

        // Create dynamic placeholders (?, ?, ?)
        $placeholders = rtrim(str_repeat('?,', count($themeIDsArray)), ',');
        $query = "SELECT * FROM tour_themes WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($query);
        $stmt->execute($themeIDsArray);
        $themesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<body id="selectToursPage">

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

    <!-- Customize Tours section starts -->
    <section id="select-city" class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tours">Tours</a></li>
                    <?php if (!empty($themesData)): ?>
                        <?php foreach ($themesData as $t): ?>
                            <li class="breadcrumb-item active">
                                <?php echo htmlspecialchars($t['theme_name']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ol>
            </nav>

            <div class="row">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer starts -->
    <?php include 'parts/footer.php'; ?>
    <!-- Footer ends -->

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