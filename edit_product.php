<?php
include 'config.php';

$id = $_GET['id'];

// Update product
if(isset($_POST['update'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if a new image was uploaded
    if(!empty($_FILES['image']['name'])){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp,"images/products/".$image);

        $stmt = $mysqli->prepare("UPDATE products SET name=?, category=?, description=?, price=?, stock=?, image=? WHERE id=?");

        $stmt->bind_param(
            "sssdssi",
            $name,
            $category,
            $description,
            $price,
            $stock,
            $image,
            $id
        );

    }else{

        $stmt = $mysqli->prepare("UPDATE products SET name=?, category=?, description=?, price=?, stock=? WHERE id=?");

        $stmt->bind_param(
            "sssdsi",
            $name,
            $category,
            $description,
            $price,
            $stock,
            $id
        );

    }

    if($stmt->execute()){
        header("Location: admin_products.php");
        exit();
    }
}

$result = $mysqli->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>

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

input,textarea,select{

width:100%;
padding:12px;
margin-bottom:15px;

}

button{

background:#0b6cf7;
color:white;
padding:12px 25px;
border:none;
cursor:pointer;

}

img{

width:120px;
margin-bottom:15px;

}

</style>

</head>

<body>

<div class="container">

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="name"
value="<?= htmlspecialchars($product['name']) ?>"
required>

<select name="category">

<?php

$cats = [
"Printer Supplies",
"Accessories",
"Storage",
"Networking",
"Power",
"Printers"
];

foreach($cats as $cat){

$selected = ($product['category']==$cat) ? "selected" : "";

echo "<option $selected>$cat</option>";

}

?>

</select>

<textarea
name="description"><?= htmlspecialchars($product['description']) ?></textarea>

<input
type="number"
step="0.01"
name="price"
value="<?= $product['price'] ?>">

<select name="stock">

<option <?= $product['stock']=="In Stock" ? "selected":"" ?>>
In Stock
</option>

<option <?= $product['stock']=="Out of Stock" ? "selected":"" ?>>
Out of Stock
</option>

</select>

<p><strong>Current Image</strong></p>

<img src="images/products/<?= htmlspecialchars($product['image']) ?>">

<input
type="file"
name="image">

<button
name="update">

Update Product

</button>

</form>

</div>

</body>
</html>