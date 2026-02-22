<?php
/**
 * Email Configuration for PHPMailer
 *
 * This file contains sensitive SMTP credentials and should be kept
 * outside the public_html directory for security.
 *
 * @package Matcon Productions
 */

// Prevent direct access
if (!defined('APP_RUNNING')) {
    die('Direct access denied');
}

// SMTP Configuration
define('SMTP_HOST', 'mail.matconproductions.com');
define('SMTP_PORT', 465);
define('SMTP_USER', 'info@matconproductions.com');
define('SMTP_PASS', '!m2&q.p$XSUM.~S5');
define('SMTP_SECURE', 'ssl'); // 'ssl' for port 465, 'tls' for port 587

// Email Settings
define('EMAIL_FROM', 'info@matconproductions.com');
define('EMAIL_FROM_NAME', 'Matcon Productions Website');
define('EMAIL_RECIPIENT', 'info@matconproductions.com');
define('EMAIL_SUBJECT', 'New Contact Form Submission - Matcon Productions');
