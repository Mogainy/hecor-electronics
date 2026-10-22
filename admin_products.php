<?php
 
include 'config.php';

// Fetch all products
$result = $mysqli->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Management</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:30px;
}

h1{
    color:#0b6cf7;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.add-btn{
    background:#0b6cf7;
    color:white;
    padding:12px 18px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

th,td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th{
    background:#0b6cf7;
    color:white;
}

img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:8px;
}

.edit{
    background:#28a745;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:6px;
}

.delete{
    background:red;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:6px;
}

</style>

</head>

<body>
<div style="margin:20px 0;display:flex;gap:10px;flex-wrap:wrap;">

<a href="admin_dashboard.php"
style="background:#0b6cf7;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:8px;">
🏠 Dashboard
</a>

<a href="add_product.php"
style="background:#28a745;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:8px;">
➕ Add Product
</a>

<a href="catalog.php"
target="_blank"
style="background:#6f42c1;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:8px;">
📖 View Catalog
</a>

<a href="logout.php"
style="background:#dc3545;
color:white;
padding:10px 18px;
text-decoration:none;
border-radius:8px;">
🚪 Logout
</a>

</div>
<div class="top">

<h1>Product Management</h1>

<a href="add_product.php" class="add-btn">
+ Add Product
</a>

</div>

<table>

<tr>
<th>Image</th>
<th>Product</th>
<th>Category</th>
<th>Price</th>
<th>Quantity</th>
<th>Stock</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>
<img src="images/products/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['category']; ?></td>

<td>KES <?php echo number_format($row['price']); ?></td>

<td><?php echo $row['quantity']; ?></td>

<td><?php echo $row['stock']; ?></td>
<td>

<a class="edit"
href="edit_product.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="delete"
href="delete_product.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this product?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>