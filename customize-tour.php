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

    // Collect all images into one array
    foreach ($themesData as $theme) {
        $images = json_decode($theme['theme_images'], true);

        if ($images) {
            foreach ($images as $img) {
                $allImages[] = $img;
            }
        }
    }
}

// Fetch country codes from DB
$countryCodes = [];
try {
    $stmt = $conn->prepare("SELECT country_name, country_code FROM country_codes ORDER BY country_name ASC");
    $stmt->execute();
    $countryCodes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Handle error
    error_log("Error fetching country codes: " . $e->getMessage());
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
    <title><?php echo WEBSITE_NAME; ?> | Customize Tour</title>

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

        <style>
        .dropdown-menu {
            display: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .dropdown-menu.show {
            display: block;
            max-height: 500px; 
        }

        .input-group-sm > .btn, .input-group-sm > .form-control {
            height: 30px;
            font-size: 0.875rem;
        }

        .star-rating {
    display: flex;
    flex-direction: row-reverse;
    font-size: 1.5rem;
    justify-content: flex-start;
}

.star-rating input {
    display: none;
}

.star-rating label {
    color: #ddd;
    cursor: pointer;
    margin-right: 5px;
    transition: color 0.2s;
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}
    </style>
</head>

<body id="toursCustomizePage">

    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero section starts -->
    <section id="hero">
        <img src="assets/images/cutomize-tour-hero.jpg" alt="Explore Vacations - Tours">
        <div class="hero-content">
            <h1>Customize Tours</h1>
        </div>
    </section>
    <!-- Hero section ends -->

    <!-- Customize Tours section starts -->
    <section id="customize-tour" class="py-5">
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

            <h2 class="heading mb-4">Plan Your Tour..</h2>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div id="tourCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php if (!empty($allImages)): ?>
                                    <?php foreach ($allImages as $index => $img): ?>
                                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="assets/<?php echo ltrim($img, '/'); ?>" class="d-block w-100 rounded" alt="Tour Image">
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="carousel-item active">
                                        <img src="assets/images/default-theme.jpg" class="d-block w-100 rounded" alt="No Image">
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="carousel-indicators">
                                <?php foreach ($allImages as $index => $img): ?>
                                    <button type="button" data-bs-target="#tourCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-auto trip-options">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tripOption" id="optionCustomize" value="customize">
                        <label class="form-check-label fw-semibold" for="optionCustomize">Customize Your Trip ✨</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tripOption" id="optionGuide" value="guide">
                        <label class="form-check-label fw-semibold" for="optionGuide">Need Help With Planning? 🧭</label>
                    </div>
                </div>
            </div>

            <hr>

            <div id="customizeForm" style="display:none;">
                <div class="intro row align-items-center mt-4">
                    <div class="col">
                        <p class="mb-0">
                            Pick cities you want to explore, ✨ customize your trip, and send us your plan. We'll guide you through the next steps and put together a full itinerary with cozy stays 🏨, fun activities 🎉, and all the details you need...
                        </p>
                    </div>
                </div>
                <hr>

                <div class="card mt-4 border-0">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label fw-semibold">Dates</label>
                            <div class="input-group">
                                <input type="date" class="form-control text-center" name="start_date" placeholder="Start Date">
                                <input type="number" class="form-control text-center" name="nights" placeholder="Nights" min="1">
                                <input type="date" class="form-control text-center" name="end_date" placeholder="End Date">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label fw-semibold">Guests</label>
                            <div class="dropdown">
                                <button class="form-control text-start" type="button" id="guestDropdownButton">
                                    2 Adults, 0 Children, 0 Infants
                                </button>
                                <div class="dropdown-menu p-3" id="guestDropdownMenu" style="min-width: 250px;">
                                    <!-- Adults -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Adults</span>
                                        <div class="input-group input-group-sm" style="width: 100px;">
                                            <button class="btn btn-outline-secondary decrement" type="button" data-target="adults">-</button>
                                            <input type="number" class="form-control text-center" id="adults" value="2" min="1" readonly>
                                            <button class="btn btn-outline-secondary increment" type="button" data-target="adults">+</button>
                                        </div>
                                    </div>

                                    <!-- Children 6-11 -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Children (6-11)</span>
                                        <div class="input-group input-group-sm" style="width: 100px;">
                                            <button class="btn btn-outline-secondary decrement" type="button" data-target="children_6_11">-</button>
                                            <input type="number" class="form-control text-center" id="children_6_11" value="0" min="0" readonly>
                                            <button class="btn btn-outline-secondary increment" type="button" data-target="children_6_11">+</button>
                                        </div>
                                    </div>

                                    <!-- Children 12+ -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Children (12+)</span>
                                        <div class="input-group input-group-sm" style="width: 100px;">
                                            <button class="btn btn-outline-secondary decrement" type="button" data-target="children_above_11">-</button>
                                            <input type="number" class="form-control text-center" id="children_above_11" value="0" min="0" readonly>
                                            <button class="btn btn-outline-secondary increment" type="button" data-target="children_above_11">+</button>
                                        </div>
                                    </div>

                                    <!-- Infants -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Infants</span>
                                        <div class="input-group input-group-sm" style="width: 100px;">
                                            <button class="btn btn-outline-secondary decrement" type="button" data-target="infants">-</button>
                                            <input type="number" class="form-control text-center" id="infants" value="0" min="0" readonly>
                                            <button class="btn btn-outline-secondary increment" type="button" data-target="infants">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label fw-semibold">Preferred Hotel Rating</label>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hotelRating" id="rating3" value="3">
                                    <label class="form-check-label" for="rating3">3 <span style="color:#ab9629">&#9733;</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hotelRating" id="rating4" value="4">
                                    <label class="form-check-label" for="rating4">4 <span style="color:#ab9629">&#9733;</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hotelRating" id="rating5" value="5">
                                    <label class="form-check-label" for="rating5">5 <span style="color:#ab9629">&#9733;</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row my-3">
                        <div class="col-12 col-md-6">
                            <label for="pickupLocation" class="form-label fw-semibold">Pickup Location</label>
                            <input type="text" class="form-control" id="pickupLocation" name="pickupLocation" placeholder="Enter pickup location" required>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="dropoffLocation" class="form-label fw-semibold">Dropoff Location</label>
                            <input type="text" class="form-control" id="dropoffLocation" name="dropoffLocation" placeholder="Enter dropoff location" required>
                        </div>
                    </div>

                    <hr>

                    <div class="cities row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center text-nowrap">
                                <h3 class="me-3 mb-0">Add City</h3>
                                <input type="text" id="cityInput" class="form-control me-2" placeholder="Enter city or location">
                                <button class="btn btn-primary" id="addCityBtn"><img src="assets/images/icons/plus.svg" class="img-fluid" alt="button"></button>
                            </div>

                            <!-- Hidden initially -->
                            <div class="d-flex justify-content-between align-items-center mt-4" id="addedCitiesContainer" style="display:none;">
                                <h3 id="addedCitiesHeading" style="display:none;">Added Cities</h3>
                                <button class="btn btn-sm btn-danger remove-btn" id="removeAllBtn" style="display:none;">
                                    <img src="assets/images/icons/bin.svg" class="img-fluid bin-button">
                                </button>
                            </div>
                            <ul class="list-group mt-2" id="cityList" style="display:none;"></ul>
                        </div>

                        <div class="col-md-6 mt-4 mt-md-0" id="mapContainer" style="display:none;">
                            <h3>Tour Map</h3>
                            <div id="map" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label fw-semibold d-block">Preferred Meal Plan</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealPlan" id="mealPlan1" value="Breakfast Only">
                                <label class="form-check-label" for="mealPlan1">Breakfast Only</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealPlan" id="mealPlan2" value="Half Board">
                                <label class="form-check-label" for="mealPlan2">Half Board</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealPlan" id="mealPlan3" value="Full Board">
                                <label class="form-check-label" for="mealPlan3">Full Board</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealPlan" id="mealPlan4" value="All Inclusive">
                                <label class="form-check-label" for="mealPlan4">All Inclusive</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label fw-semibold d-block">Do you have any meal allergy issues?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealAllergy" id="mealAllergyYes" value="Yes">
                                <label class="form-check-label" for="mealAllergyYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mealAllergy" id="mealAllergyNo" value="No">
                                <label class="form-check-label" for="mealAllergyNo">No</label>
                            </div>
                            <div class="mt-2" id="allergyDetails" style="display:none;">
                                <input type="text" class="form-control" placeholder="Please specify your allergy">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col-auto">
                                    <label for="title" class="form-label small">Title<span class="text-danger">*</span></label>
                                    <select class="form-select" id="title" name="title" required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="fullName" class="form-label">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col-auto code" style="width:50%;">
                                    <label for="whatsappCode" class="form-label small">Code<span class="text-danger">*</span></label>
                                    <select class="form-select" id="whatsappCode" name="whatsappCode" required>
                                        <option value="" selected disabled>Select</option>
                                        <?php foreach($countryCodes as $c): ?>
                                            <option value="<?php echo htmlspecialchars($c['country_code']); ?>">
                                                <?php echo htmlspecialchars($c['country_name'] . ' (' . $c['country_code'] . ')'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="whatsapp" class="form-label">WhatsApp Number<span class="text-danger">*</span></label>
                                    <input type="phone" class="form-control" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp number" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="country">Country<span class="text-danger">*</span></label>
                            <select class="form-select" id="country" name="country" required>
                                <option value="" selected disabled>Select your country</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="nationality">Nationality<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter your Nationality" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="flightNumber">Flight Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="flightNumber" name="flightNumber" placeholder="Enter flight number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label fw-semibold" for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Any remarks or requests"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary submit-button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contactSection" class="my-4" style="display:none;">
                <p class="lead">
                    Need a hand planning your trip? Contact us and we’ll help you create an amazing itinerary! 📩
                </p>
                <a href="./contact" class="btn btn-primary contact-button">Contact Us</a>
            </div>
        </div>
    </section>
    <!-- Customize Tours section ends -->

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
        let pickupAutocomplete, dropoffAutocomplete;

        function initPickupDropoffAutocomplete() {
            // Restrict to Sri Lanka or remove if global
            const options = {
                componentRestrictions: { country: "lk" }, 
                fields: ["geometry", "name", "formatted_address"]
            };

            pickupAutocomplete = new google.maps.places.Autocomplete(document.getElementById("pickupLocation"), options);
            dropoffAutocomplete = new google.maps.places.Autocomplete(document.getElementById("dropoffLocation"), options);

            pickupAutocomplete.addListener("place_changed", () => {
                const place = pickupAutocomplete.getPlace();
                if (!place.geometry) {
                    alert("Please select a pickup location from the dropdown");
                }
            });

            dropoffAutocomplete.addListener("place_changed", () => {
                const place = dropoffAutocomplete.getPlace();
                if (!place.geometry) {
                    alert("Please select a dropoff location from the dropdown");
                }
            });
        }

        // Call this inside your existing initMap callback or on DOMContentLoaded
        google.maps.event.addDomListener(window, 'load', initPickupDropoffAutocomplete);
    </script>

    <script>
        const optionCustomize = document.getElementById('optionCustomize');
        const optionGuide = document.getElementById('optionGuide');
        const customizeForm = document.getElementById('customizeForm');
        const contactSection = document.getElementById('contactSection');

        document.querySelectorAll('input[name="tripOption"]').forEach(input => {
            input.addEventListener('change', () => {
                if(optionCustomize.checked){
                    customizeForm.style.display = 'block';
                    contactSection.style.display = 'none';
                } else if(optionGuide.checked){
                    customizeForm.style.display = 'none';
                    contactSection.style.display = 'block';
                }
            });
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl50Q8W4ZF2_EkOJ1lnRoVxO1IdjIupjM&libraries=places&callback=initMap" async defer></script>

    <script>
        const btn = document.getElementById('guestDropdownButton');
        const menu = document.getElementById('guestDropdownMenu');
        const ids = ['adults','children_6_11','children_above_11','infants'];

        btn.addEventListener('click', () => menu.classList.toggle('show'));
        document.addEventListener('click', e => { if(!btn.contains(e.target)&&!menu.contains(e.target)) menu.classList.remove('show'); });

        function update() {
            const adults = +document.getElementById('adults').value;
            const children = ids.slice(1).reduce((s,id)=>s + +document.getElementById(id).value,0);
            btn.textContent = `${adults} Adults, ${children} Children`;
        }

        document.querySelectorAll('.increment,.decrement').forEach(b=>{
            b.addEventListener('click', ()=>{
                const i = document.getElementById(b.dataset.target);
                const min = +i.min||0;
                i.value = Math.max(min, +i.value + (b.classList.contains('increment')?1:-1));
                update();
            });
        });

        update();

    </script>

    <script>
        let map, autocomplete;
        let markers = [];
        let locations = [];
        let polyline;

        function initMap() {
            // Initialize map
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 7
            });

            polyline = new google.maps.Polyline({
                path: locations,
                geodesic: true,
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 3,
                map: map
            });

            // Google Places Autocomplete restricted to Sri Lanka
            autocomplete = new google.maps.places.Autocomplete(document.getElementById("cityInput"), {
                componentRestrictions: { country: "lk" },
                fields: ["geometry", "name", "formatted_address"]
            });

            autocomplete.addListener("place_changed", onPlaceSelected);
        }

        function onPlaceSelected() {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                alert("Please select a location from the dropdown");
                return;
            }

            addLocation(place.geometry.location.lat(), place.geometry.location.lng(), place.formatted_address);
            document.getElementById("cityInput").value = "";
        }

        document.getElementById("addCityBtn").addEventListener("click", () => {
            const input = document.getElementById("cityInput").value.trim();
            if (!input) return;
            // Trigger place selection from autocomplete manually
            google.maps.event.trigger(autocomplete, 'place_changed');
        });

        document.getElementById("removeAllBtn").addEventListener("click", removeAllLocations);

        function addLocation(lat, lng, label) {
            const location = { lat, lng };
            locations.push(location);

            // Add marker
            const marker = new google.maps.Marker({ map, position: location, title: label });
            markers.push(marker);

            // Update polyline
            polyline.setPath(locations);

            // Fit map bounds
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(m => bounds.extend(m.getPosition()));
            map.fitBounds(bounds);

            // Show map, added cities container, city list, and remove all button
            document.getElementById("addedCitiesContainer").style.display = "flex";
            document.getElementById("cityList").style.display = "block";
            document.getElementById("mapContainer").style.display = "block";
            document.getElementById("removeAllBtn").style.display = "inline-block";
            document.getElementById("addedCitiesHeading").style.display = "block"; // show heading


            // Add to list with remove button
            const li = document.createElement("li");
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.innerHTML = `<span>${label}</span> <button class="btn btn-sm btn-outline-danger"><img src="assets/images/icons/bin.svg" class="img-fluid bin-button"></button>`;
            document.getElementById("cityList").appendChild(li);

            const index = markers.length - 1;
            li.querySelector("button").addEventListener("click", () => removeSingle(index, li));
        }

        function removeSingle(index, li) {
            if (markers[index]) {
                markers[index].setMap(null);
                markers.splice(index, 1);
                locations.splice(index, 1);
                polyline.setPath(locations);
                li.remove();
            }
            updateMapBounds();

            if (markers.length === 0) {
                // Hide everything if no cities left
                document.getElementById("addedCitiesContainer").style.display = "none";
                document.getElementById("cityList").style.display = "none";
                document.getElementById("mapContainer").style.display = "none";
                document.getElementById("removeAllBtn").style.display = "none";
                document.getElementById("addedCitiesHeading").style.display = "none"; // hide heading

            }
        }


        function removeAllLocations() {
            markers.forEach(m => m.setMap(null));
            markers = [];
            locations = [];
            polyline.setPath([]);
            document.getElementById("cityList").innerHTML = "";

            // Hide map and added cities section
            document.getElementById("addedCitiesContainer").style.display = "none";
            document.getElementById("cityList").style.display = "none";
            document.getElementById("mapContainer").style.display = "none";

            updateMapBounds();
        }

        function updateMapBounds() {
            if (markers.length) {
                const bounds = new google.maps.LatLngBounds();
                markers.forEach(m => bounds.extend(m.getPosition()));
                map.fitBounds(bounds);
            } else {
                map.setCenter({ lat: 7.8731, lng: 80.7718 });
                map.setZoom(7);
            }
        }
    </script>

    <script>
        const yesRadio = document.getElementById('mealAllergyYes');
        const noRadio = document.getElementById('mealAllergyNo');
        const allergyInput = document.getElementById('allergyDetails');

        yesRadio.addEventListener('change', () => {
            allergyInput.style.display = yesRadio.checked ? 'block' : 'none';
        });

        noRadio.addEventListener('change', () => {
            allergyInput.style.display = 'none';
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const countrySelect = document.getElementById("country");
            fetch("https://restcountries.com/v3.1/all?fields=name")
                .then(res => res.json())
                .then(data => Array.isArray(data) && 
                    data.sort((a,b) => a.name.common.localeCompare(b.name.common))
                        .forEach(c => countrySelect.add(new Option(c.name.common, c.name.common)))
                )
                .catch(err => console.error("Error fetching countries:", err));
        });
    </script>


</body>
</html>
