<?php
// Define website settings
define('WEBSITE_NAME', 'Ceylon Adventure Tours');
define('WEBSITE_DESCRIPTION', "CEYLON ADVENTURE TOURS, with over 20 years of experience in Motorcycle Tours & Rentals, our expert team is renowned for crafting unique journeys. Our team of seasoned tour operators isn't just well-experienced; they're passionate adventurers with a deep love for exploration. We've earned recognition not only within Sri Lanka but also on the global stage for our unmatched uniqueness and quality service. We're not just tour operators; we're storytellers who provide professional and friendly service for your ultimate satisfaction. Join us in exploring Sri Lanka, where adventure meets excellence");
define('WEBSITE_KEYWORDS', "adventure tours, ceylon adventure tours, motorcycle tours, adventure, explore, discover, experience, travel, tours in ella, tours in vietnam, honda bikes in ella, royal enfield in ella");

// Define email Configuration
// Define email Configuration
define('MAIL_MAILER', 'smtp');
define('SMTP_HOST', 'sandbox.smtp.mailtrap.io');
define('SMTP_USERNAME', '19cb44f28a2e8e');
define('SMTP_PASSWORD', 'a2ded8e7904720');
define('SMTP_PORT', 2525);
define('SMTP_FROM_EMAIL', 'no-reply@example.com');
define('MAIL_ENCRYPTION', 'tls');
define('SMTP_FROM_NAME', 'Ceylon Adventure Tours');

// Timezone
date_default_timezone_set('Asia/Colombo');
// Maximum allowed file size (in bytes)
define('MAX_FILE_SIZE', 3 * 1024 * 1024); // 3MB

// Define Google reCAPTCHA keys for form verification
define('GOOGLE_RECAPTCHA_SITE_KEY', '6Lfi4e8qAAAAAOji3ztqb74m99mImbQEsS-mVNWF');
define('GOOGLE_RECAPTCHA_SECRET_KEY', '6Lfi4e8qAAAAAG9oBvz8UxOqzSn39XdyivyqR9YY');

// reCAPTCHA verification function
function verifyRecaptcha($recaptcha_response) {
    $recaptcha_secret = GOOGLE_RECAPTCHA_SECRET_KEY;
    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response"), true);
    return !empty($response['success']) && $response['success'] && $response['score'] >= 0.5;
}

//user input validation function
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
