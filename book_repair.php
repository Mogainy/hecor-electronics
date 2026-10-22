<?php
// book_repair.php
require_once 'config.php';

// Simple server-side validation and sanitation
$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$device_type = trim($_POST['device_type'] ?? '');
$issue_description = trim($_POST['issue_description'] ?? '');
$preferred_date = $_POST['preferred_date'] ?? null;

if (!$full_name || !$phone || !$device_type || !$issue_description) {
    die('Please fill the required fields. <a href="javascript:history.back()">Go back</a>');
}

$stmt = $mysqli->prepare("INSERT INTO bookings (full_name, phone, email, device_type, issue_description, preferred_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $full_name, $phone, $email, $device_type, $issue_description, $preferred_date);
$ok = $stmt->execute();
if ($ok) {
    // Send email notification (PHPMailer SMTP)
    require_once 'email_notification.php';
    send_new_booking_email($full_name, $phone, $email, $device_type, $issue_description, $preferred_date);

    header('Location: success.html');
    exit;
} else {
    echo 'Database error: ' . $mysqli->error;
}
?>