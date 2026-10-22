<?php
// email_notification.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| SMTP CONFIGURATION
|--------------------------------------------------------------------------
*/
$smtpHost = 'smtp.gmail.com';
$smtpUsername = 'Youremail';
$smtpPassword = 'password for app password';
$smtpPort = 587;
$smtpSecure = 'tls';

/*
|--------------------------------------------------------------------------
| SEND NEW BOOKING NOTIFICATION TO ADMIN
|--------------------------------------------------------------------------
*/
function send_new_booking_email($name, $phone, $email, $device, $issue, $date)
{
    global $smtpHost, $smtpUsername, $smtpPassword, $smtpPort, $smtpSecure;

    $toEmail = 'Youremail';

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port       = $smtpPort;

        $mail->setFrom($smtpUsername, 'HECOR Notifications');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);

        $mail->Subject = "New Booking from {$name}";

        $mail->Body = "
            <h2>New Booking Received</h2>

            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Device:</strong> {$device}</p>
            <p><strong>Preferred Date:</strong> {$date}</p>

            <p><strong>Issue:</strong></p>
            <p>{$issue}</p>
        ";

        $mail->send();

    } catch (Exception $e) {

        error_log('Mail error: ' . $mail->ErrorInfo);

    }
}

/*
|--------------------------------------------------------------------------
| SEND STATUS UPDATE TO CUSTOMER
|--------------------------------------------------------------------------
*/
function send_status_update_email($customerEmail, $customerName, $status)
{
    global $smtpHost, $smtpUsername, $smtpPassword, $smtpPort, $smtpSecure;

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port       = $smtpPort;

        $mail->setFrom($smtpUsername, 'HECOR Repairs');
        $mail->addAddress($customerEmail);

        if ($status == 'Pending') {

            $message = "
                Your booking has been received and is awaiting processing.
            ";

        } elseif ($status == 'In-Progress') {

            $message = "
                Our technicians are currently working on your device.
            ";

        } elseif ($status == 'Completed') {

            $message = "
                Your device has been repaired and is ready for collection.
            ";

        } else {

            $message = "
                Your booking status has been updated.
            ";
        }

        $mail->isHTML(true);

        $mail->Subject = "HECOR Booking Status Update";

        $mail->Body = "
            <h2>Hello {$customerName},</h2>

            <p>{$message}</p>

            <p>
                <strong>Current Status:</strong>
                {$status}
            </p>

            <p>
                Thank you for choosing HECOR Repairs.
            </p>
        ";

        $mail->send();

    } catch (Exception $e) {

        error_log('Mail error: ' . $mail->ErrorInfo);

    }
}
?>