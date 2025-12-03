<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class EmailSender {
    private $mailer;

    public function __construct() {
        // Create a PHPMailer instance and enable exceptions
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    private function configureMailer() {
        // Set up the mailer with SMTP settings
        $this->mailer->isSMTP();
        $this->mailer->SMTPDebug = 0; 
        $this->mailer->Host = SMTP_HOST;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = SMTP_USERNAME;
        $this->mailer->Password = SMTP_PASSWORD;
        $this->mailer->SMTPSecure = MAIL_ENCRYPTION;
        $this->mailer->Port = SMTP_PORT;

        // Set the 'from' address and enable HTML content
        $this->mailer->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $this->mailer->isHTML(true);
    }

    public function sendEmail($to=null, $subject='Email Subject', $content='Email Body', $cc = [], $bcc = [], $attachments = []) {
        // Add the primary recipient and set the subject and email content
        $this->mailer->addAddress($to);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $content;
    
        // Add CC recipients if any
        foreach ($cc as $ccAddress) {
            $this->mailer->addCC($ccAddress);
        }
    
        // Add BCC recipients if any
        foreach ($bcc as $bccAddress) {
            $this->mailer->addBCC($bccAddress);
        }
    
        // Attach files if specified
        foreach ($attachments as $attachment) {
            // Ensure the attachment is a valid file path
            if (isset($attachment['tmp_name']) && is_file($attachment['tmp_name'])) {
                $this->mailer->addAttachment($attachment['tmp_name'], $attachment['name']);
            }
        }
    
        // Send the email
        try {
            $sendStatus = $this->mailer->send();
            if ($sendStatus) {
                return true;
            } else {
                error_log('[' . date('Y-m-d H:i:s') . '] Error: Email could not be sent: ' . $this->mailer->ErrorInfo . PHP_EOL, 3, 'error.log');
                return false;
            }
        } catch (Exception $e) {
            error_log('[' . date('Y-m-d H:i:s') . '] Error: Email could not be sent: ' . $e->getMessage() . PHP_EOL, 3, 'error.log');
            return false;
        }
    }   
}