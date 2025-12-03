<?php
// Define website settings
define('WEBSITE_NAME', 'Explore Vacations');
define('WEBSITE_DESCRIPTION', "Explore Vacations is your trusted travel partner for discovering the world's most breathtaking destinations. From relaxing beach escapes to adventure-filled tours, we curate unforgettable travel experiences for families, couples, and solo explorers. Our team is dedicated to providing personalized itineraries, reliable service, and seamless journeys—ensuring your vacation is filled with comfort, excitement, and unforgettable memories.");
define('WEBSITE_KEYWORDS', "Explore Vacations, travel agency, holiday packages, adventure tours, family vacations, honeymoon trips, custom travel plans, worldwide tours, beach holidays, nature tours, travel experiences, vacation planning, guided tours");

// Define email Configuration
define('MAIL_MAILER', 'smtp');
define('SMTP_HOST', 'sandbox.smtp.mailtrap.io');
define('SMTP_USERNAME', '19cb44f28a2e8e');
define('SMTP_PASSWORD', 'a2ded8e7904720');
define('SMTP_PORT', 2525);
define('SMTP_FROM_EMAIL', 'no-reply@example.com');
define('MAIL_ENCRYPTION', 'tls');
define('SMTP_FROM_NAME', 'Explore Vacations');

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
