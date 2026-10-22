<?php

// admin_dashboard.php
session_start();
require_once 'config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {

    require_once 'email_notification.php';

    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    // Get customer details
    $customer = $mysqli->prepare("
        SELECT full_name, email
        FROM bookings
        WHERE booking_id = ?
    ");

    $customer->bind_param('i', $id);
    $customer->execute();

    $resultCustomer = $customer->get_result();
    $booking = $resultCustomer->fetch_assoc();

    // Update status
    $stmt = $mysqli->prepare("
        UPDATE bookings
        SET status = ?
        WHERE booking_id = ?
    ");

    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {

        // Send email to customer
        if (!empty($booking['email'])) {

            send_status_update_email(
                $booking['email'],
                $booking['full_name'],
                $status
            );

        }
    }
}


// Fetch bookings
$result = $mysqli->query('SELECT * FROM bookings ORDER BY created_at DESC');
// Dashboard Statistics

$totalBookings = $mysqli->query("SELECT COUNT(*) AS total FROM bookings")
                        ->fetch_assoc()['total'];

$totalProducts = $mysqli->query("SELECT COUNT(*) AS total FROM products")
                        ->fetch_assoc()['total'];

$lowStock = $mysqli->query("SELECT COUNT(*) AS total FROM products WHERE quantity <= 5 AND quantity > 0")
                   ->fetch_assoc()['total'];

$outOfStock = $mysqli->query("SELECT COUNT(*) AS total FROM products WHERE quantity = 0")
                     ->fetch_assoc()['total'];
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Dashboard</title></head>
<body style="font-family:Arial,Helvetica,sans-serif;padding:18px;background:#f7f9fb;">
  <div style="max-width:1100px;margin:0 auto">
   <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">

<div>

<h1 style="margin:0;color:#0b6cf7;">
HECOR ADMIN
</h1>

<p style="margin-top:6px;color:#666;">
Computer & Electronics Management System
</p>

</div>

<div>

<span>
Welcome,
<b><?php echo htmlspecialchars($_SESSION['admin_user']); ?></b>
</span>

<a href="logout.php"
style="margin-left:20px;
background:#dc3545;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:6px;">

Logout

</a>

</div>

</div>
<div style="display:flex;gap:15px;margin-bottom:25px;flex-wrap:wrap;">

<a href="admin_dashboard.php"
style="padding:12px 18px;background:#0b6cf7;color:white;text-decoration:none;border-radius:8px;">
Dashboard
</a>

<a href="admin_products.php"
style="padding:12px 18px;background:#28a745;color:white;text-decoration:none;border-radius:8px;">
Products
</a>

<a href="add_product.php"
style="padding:12px 18px;background:#17a2b8;color:white;text-decoration:none;border-radius:8px;">
Add Product
</a>

<a href="catalog.php"
target="_blank"
style="padding:12px 18px;background:#6f42c1;color:white;text-decoration:none;border-radius:8px;">
View Catalog
</a>

</div>
<div style="display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;">

<div style="background:#0b6cf7;color:white;padding:25px;border-radius:12px;">
<h3><?php echo $totalBookings; ?></h3>
<p>Total Bookings</p>
</div>

<div style="background:#28a745;color:white;padding:25px;border-radius:12px;">
<h3><?php echo $totalProducts; ?></h3>
<p>Total Products</p>
</div>

<div style="background:#ffc107;color:black;padding:25px;border-radius:12px;">
<h3><?php echo $lowStock; ?></h3>
<p>Low Stock</p>
</div>

<div style="background:#dc3545;color:white;padding:25px;border-radius:12px;">
<h3><?php echo $outOfStock; ?></h3>
<p>Out of Stock</p>
</div>

</div>
    <table border="0" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;margin-top:12px;background:white;border-radius:6px;overflow:hidden">
      <thead style="background:#eef6ff"><tr>
        <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Device</th><th>Preferred Date</th><th>Notes</th><th>Status</th><th>Created</th><th>Action</th>
      </tr></thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr style="border-top:1px solid #f1f5f9">
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['device_type']); ?></td>
            <td><?php echo htmlspecialchars($row['preferred_date']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['issue_description'])); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <form method="post" style="display:inline-block">
                <input type="hidden" name="id" value="<?php echo $row['booking_id']; ?>">
                <select name="status">
                  <option<?php if($row['status']=='Pending') echo ' selected'; ?>>Pending</option>
                  <option<?php if($row['status']=='In-Progress') echo ' selected'; ?>>In-Progress</option>
                  <option<?php if($row['status']=='Completed') echo ' selected'; ?>>Completed</option>
                </select>
                <button type="submit" name="update_status">Update</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body></html>