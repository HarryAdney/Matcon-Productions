<?php
/**
 * Contact Form Handler for Matcon Productions
 *
 * Processes contact form submissions and sends emails via PHPMailer
 *
 * @package Matcon Productions
 */

// Define app running constant for config security
define('APP_RUNNING', true);

// Set headers for JSON response and CORS
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Please use POST.'
    ]);
    exit;
}

// Load configuration
$configPath = dirname(__DIR__) . '/config/email_config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server configuration error. Please try again later.'
    ]);
    exit;
}
require_once $configPath;

// Load PHPMailer
$phpMailerPath = dirname(__DIR__) . '/phpmailer/src/PHPMailer.php';
$smtpPath = dirname(__DIR__) . '/phpmailer/src/SMTP.php';
$exceptionPath = dirname(__DIR__) . '/phpmailer/src/Exception.php';

if (!file_exists($phpMailerPath) || !file_exists($smtpPath) || !file_exists($exceptionPath)) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server configuration error. Please try again later.'
    ]);
    exit;
}

require_once $exceptionPath;
require_once $phpMailerPath;
require_once $smtpPath;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Sanitize input data
 *
 * @param string $data Raw input data
 * @return string Sanitized data
 */
function sanitizeInput(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $data;
}

/**
 * Validate email address
 *
 * @param string $email Email to validate
 * @return bool True if valid, false otherwise
 */
function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Get and validate form data
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

// Honeypot check for spam prevention
if (!empty($_POST['_honey'])) {
    // Silently reject spam submissions
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully.'
    ]);
    exit;
}

// Validate required fields
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required.';
} elseif (strlen($name) > 100) {
    $errors[] = 'Name must be less than 100 characters.';
}

if (empty($email)) {
    $errors[] = 'Email is required.';
} elseif (!isValidEmail($email)) {
    $errors[] = 'Please provide a valid email address.';
} elseif (strlen($email) > 254) {
    $errors[] = 'Email address is too long.';
}

if (empty($message)) {
    $errors[] = 'Message is required.';
} elseif (strlen($message) > 5000) {
    $errors[] = 'Message must be less than 5000 characters.';
}

// Return validation errors if any
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Please correct the following errors:',
        'errors' => $errors
    ]);
    exit;
}

// Rate limiting check using session
session_start();
$currentTime = time();
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$sessionKey = 'last_submit_' . md5($ipAddress);

if (isset($_SESSION[$sessionKey])) {
    $timeSinceLastSubmit = $currentTime - $_SESSION[$sessionKey];
    if ($timeSinceLastSubmit < 60) { // 60 second cooldown
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Please wait before submitting another message.'
        ]);
        exit;
    }
}

try {
    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    // Enable verbose debug output for development (disable in production)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Configure SMTP
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->Port = SMTP_PORT;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = SMTP_SECURE;

    // Set sender and recipient
    $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
    $mail->addAddress(EMAIL_RECIPIENT);

    // Set Reply-To to the form submitter's email
    $mail->addReplyTo($email, $name);

    // Email content
    $mail->Subject = EMAIL_SUBJECT;

    // Build HTML email body
    $htmlBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f9f9f9; border-radius: 8px; padding: 30px; border: 1px solid #e0e0e0;">
        <h1 style="color: #2c3e50; margin-top: 0; border-bottom: 2px solid #3498db; padding-bottom: 10px;">New Contact Form Submission</h1>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px 0; font-weight: bold; color: #555; width: 120px;">Name:</td>
                <td style="padding: 10px 0;">{$name}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold; color: #555;">Email:</td>
                <td style="padding: 10px 0;"><a href="mailto:{$email}" style="color: #3498db;">{$email}</a></td>
            </tr>
            <tr>
                <td style="padding: 10px 0; font-weight: bold; color: #555; vertical-align: top;">Message:</td>
                <td style="padding: 10px 0;">
                    <div style="background-color: #fff; padding: 15px; border-radius: 4px; border: 1px solid #e0e0e0; white-space: pre-wrap;">{$message}</div>
                </td>
            </tr>
        </table>

        <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">

        <p style="font-size: 12px; color: #888; margin: 0;">
            This email was sent from the contact form on <a href="https://matconproductions.com" style="color: #3498db;">matconproductions.com</a><br>
            Submitted on: <strong>{$currentTime}</strong>
        </p>
    </div>
</body>
</html>
HTML;

    // Build plain text email body
    $textBody = <<<TEXT
NEW CONTACT FORM SUBMISSION
===========================

Name: {$name}
Email: {$email}

Message:
{$message}

---------------------------
This email was sent from the contact form on matconproductions.com
Submitted on: {$currentTime}
TEXT;

    $mail->Body = $htmlBody;
    $mail->AltBody = $textBody;
    $mail->isHTML(true);

    // Send email
    $mail->send();

    // Update rate limit timestamp
    $_SESSION[$sessionKey] = $currentTime;

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.'
    ]);

} catch (Exception $e) {
    // Log error (in production, log to file instead of output)
    error_log("Mail error: " . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again later or contact us directly.'
    ]);
}
