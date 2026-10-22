<?php

// admin_login.php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$username || !$password) {
        $error = 'Please fill both fields.';
    } else {
        $stmt = $mysqli->prepare('SELECT admin_id, password FROM admins WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($admin_id, $db_password);
        if ($stmt->fetch()) {
            // Option A: comparing plain-text passwords
            if ($password === $db_password) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_user'] = $username;
                header('Location: admin_dashboard.php');
                exit;
            } else {
                $error = 'Invalid credentials.';
            }
        } else {
            $error = 'Invalid credentials.';
        }
    }
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Login</title></head>
<body style="font-family:Arial,Helvetica,sans-serif;display:flex;align-items:center;justify-content:center;min-height:80vh;">
  <div style="width:360px;padding:20px;border-radius:8px;border:1px solid #e6eefb;background:white;">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo '<div style="color:#b91c1c">'.htmlspecialchars($error).'</div>'; ?>
    <form method="post">
      <input name="username" placeholder="Username" style="width:100%;padding:10px;margin:8px 0;border-radius:6px;border:1px solid #e6eefb" required>
      <input name="password" type="password" placeholder="Password" style="width:100%;padding:10px;margin:8px 0;border-radius:6px;border:1px solid #e6eefb" required>
      <button type="submit" style="padding:10px 14px;border-radius:8px;background:#0b6cf7;color:white;border:none">Login</button>
    </form>
  </div>
</body></html>