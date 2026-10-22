<?php
 include 'admin_nav.php';
include 'config.php';

if(isset($_POST['save'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
   $price = $_POST['price'];
$quantity = $_POST['quantity'];
$stock = $_POST['stock'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, "images/products/".$image);

    $stmt = $mysqli->prepare("INSERT INTO products(name,category,description,price,quantity,image,stock)
VALUES(?,?,?,?,?,?,?)");

    $stmt->bind_param(
"sssdiss",
$name,
$category,
$description,
$price,
$quantity,
$image,
$stock
);

    if($stmt->execute()){
        header("Location: admin_products.php");
        exit();
    }else{
        echo "Error adding product.";
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Product</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}

.container{
    width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

h2{
    color:#0b6cf7;
    margin-bottom:20px;
}

input,
textarea,
select{

width:100%;
padding:12px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;

}

button{

background:#0b6cf7;
color:white;
padding:12px 25px;
border:none;
border-radius:6px;
cursor:pointer;
font-size:16px;

}

button:hover{

background:#0957c8;

}

</style>

</head>

<body>

<div class="container">

<h2>Add New Product</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="name"
placeholder="Product Name"
required>

<select name="category">

<option>Printer Supplies</option>

<option>Accessories</option>

<option>Storage</option>

<option>Networking</option>

<option>Power</option>

<option>Printers</option>

</select>

<textarea
name="description"
placeholder="Product Description"
required></textarea>

<input
type="number"
name="price"
placeholder="Price"
required>
<input
type="number"
name="quantity"
placeholder="Quantity"
required>
<select name="stock">

<option>In Stock</option>

<option>Out of Stock</option>

</select>

<input
type="file"
name="image"
required>

<button
name="save">

Save Product

</button>

</form>

</div>

</body>
</html>