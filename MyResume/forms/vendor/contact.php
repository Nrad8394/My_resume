<?php
require_once __DIR__ . '\autoload.php';
require 'phpmailer\phpmailer\src\PHPMailer.php';
require 'phpmailer\phpmailer\src\Exception.php';

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'benjaminkaranja8393official@gmail.com';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a PHPMailer instance
$mail = new PHPMailer(true);
$sentMessage = '';

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'benjaminkaranja8393@gmail.com';
    $mail->Password   =  'awvf sdag dsoq sxgz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress($receiving_email_address);

    // Content
    $emailBody = "From: {$_POST['name']} <{$_POST['email']}>\n\n";
    $emailBody .= "Message:\n{$_POST['message']}";
    $mail->isHTML(false);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $emailBody;

    // Send email
    $sentMessage = $mail->send();

    if ($sentMessage) {
        // Email sent successfully
        $response['ok'] = true;
        $response['data'] = true;

    } else {
        // Email sending failed
        $response['ok'] = false;
        $response['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} catch (Exception $e) {
    $response['ok'] = false;
    $response['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Convert the response array to JSON format and echo it
echo json_encode($response);
?>
