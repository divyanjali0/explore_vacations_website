<?php
include ('./config.php');
include ('./classes/EmailSender.php');

$errors = [];
$name = $email = $phone = $message = "";
$recaptcha_response = "";

//checking whether the user submits the form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $message = test_input($_POST['message']);
    $recaptcha_response = filter_input(INPUT_POST, 'recaptchaResponse');

    // Verify reCAPTCHA
    if (!verifyRecaptcha($recaptcha_response)) {
        $errors['recaptcha'] = "reCAPTCHA validation failed.";
    }

    // Validate name
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

    // Validate contact number
    if (empty($phone)) {
        $errors['phone'] = "Contact number is required";
    } elseif (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
        $errors['phone'] = "Enter a valid contact number";
    }

    // Validate message
    if (empty($message)) {
        $errors['message'] = "Message is required";
    }

    if (empty($errors)) {
        $emailSender = new EmailSender();

        // Compose the email content
        $emailTo = 'navodyadivyanjali2@gmail.com';
        $emailSubject = 'Contact Form Message';
        $emailContent = "<table>
                            <tr>
                                <td><b>Name</b></td>
                                <td> : $name</td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td> : $email</td>
                            </tr>
                            <tr>
                                <td><b>Contact Number</b></td>
                                <td> : $phone</td>
                            </tr>
                            <tr>
                                <td><b>Message</b></td>
                                <td> : $message</td>
                            </tr>
                        </table>";

        $result = $emailSender->sendEmail($emailTo, $emailSubject, $emailContent);

        if ($result === true) {
            $successMessage = 'Your message has been sent successfully!';
            $name = $phone = $email = $message = "";
        } else {
            $errorMessage = 'Sorry, there was an issue sending your message. Please try again.';
        }
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
    <title><?php echo WEBSITE_NAME; ?> | Contact Us</title>

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

<body id="contactPage">
    <!-- Header starts -->
    <?php include 'parts/header.php'; ?>
    <!-- Header ends -->

    <!-- Hero starts -->
    <section id="hero">
        <img src="assets/images/contact-hero.jpg" alt="Explore Vacations - Contact Us">
        <div class="hero-content">
            <h1>Contact Us</h1>
        </div>
    </section>
    <!-- Hero ends -->

    <!-- Contact us starts -->
    <section id="contactContent" class="py-5 pb-xl-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="heading" data-aos="fade-down">Get in touch with us</p>
                </div>
            </div>
            <div class="row">
                <p class="justify-text">Have questions related to your adventures? We're here to assist you every step of the way. Contact us today to plan your tours or personalized adventures. Our dedicated team is eager to make your journey memorable, so don't hesitate to get in touch with us. Let your experience begins with just a click or a call!</p>
                <div class="img-container col-12 col-lg-5 order-lg-2" data-aos="fade-left">
                    <img src="assets/images/contact-form-img.png" alt="Explore Vacations - contact image" class= "img-fluid">
                </div>
                <div class="col-12 col-lg-7 pt-3">
                    <form action="./contact" method="POST" data-aos="fade-right">
                        <div class="row">
                            <!-- Error & success meassages -->
                            <div class="col-12 col-md-12">
                                <?php if (isset($successMessage)): ?>
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <?= $successMessage ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php elseif (isset($errorMessage)): ?>
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        <?= $errorMessage ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 my-3">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter your full name" value="<?= $name; ?>">
                                <?php if (!empty($errors['name'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['name']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 my-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email address" value="<?= $email; ?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['email']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 my-3">
                                <label for="phone" class="form-label">Phone<span
                                        class="text-danger">*</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    placeholder="Enter your contact number" value="<?= $phone; ?>">
                                <?php if (!empty($errors['phone'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['phone']; ?></span>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="recaptchaResponse" id="recaptchaResponse">
                            <div class="col-12 my-3">
                                <label for="message" class="form-label">Message<span
                                        class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" id="message" rows="5"
                                    placeholder="Enter your message here"><?= $message; ?></textarea>
                                <?php if (!empty($errors['message'])): ?>
                                    <span class="text-danger text-italic small"><?= $errors['message']; ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($errors['recaptcha'])): ?>
                                <div class="col-12">
                                    <span class="text-danger text-italic small"><?= $errors['recaptcha']; ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="col-12 mt-4">
                                <input type="submit" name="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact us ends -->

    <div style="margin-bottom: -22px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.971585687321!2d79.87321017581856!3d7.129283315825712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2f04b1fa95fa5%3A0x42cca08eb23de111!2sExplore%20Vacations%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1765448477674!5m2!1sen!2slk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

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
</body>
</html>