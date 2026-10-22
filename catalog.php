<?php
include 'config.php';

$result = $mysqli->query("SELECT * FROM products ORDER BY category, name");
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>HECOR Product Catalog</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/catalog.css">

</head>

<body>

<header>

<div class="logo">

<h1>HECOR Computers & Electronics</h1>

<p>Quality Computer Accessories, Printer Supplies & Electronics</p>

</div>

<a href="index.html" class="back-btn">

🏠 Back Home

</a>

</header>

<section class="hero">

<h2>HECOR Product Catalogue</h2>

<p>

Browse our latest products, compare prices and order directly via WhatsApp.

</p>

</section>

<section class="search-area">

<input

type="text"

id="search"

placeholder="🔍 Search for a product...">

</section>

<section class="filters">

<button class="active" data-filter="all">

All

</button>

<button data-filter="printer">

Printer Supplies

</button>

<button data-filter="accessories">

Accessories

</button>

<button data-filter="storage">

Storage

</button>

<button data-filter="network">

Networking

</button>

<button data-filter="power">

Power

</button>

<button data-filter="printers">

Printers

</button>

</section>



<section class="summary">

<div class="summary-card">
<h2><?php echo $result->num_rows; ?></h2>
<p>Products Available</p>
</div>

<div class="summary-card">
<h2>6</h2>
<p>Product Categories</p>
</div>

<div class="summary-card">
<h2>100%</h2>
<p>Genuine Products</p>
</div>

<div class="summary-card">
<h2>24/7</h2>
<p>WhatsApp Ordering</p>
</div>

</section>
<main class="products">

<?php

$currentCategory = "";

while($product = $result->fetch_assoc()){

    if($currentCategory != $product['category']){

        if($currentCategory != ""){
            echo "</div></section>";
        }

        $currentCategory = $product['category'];

        echo "
        <section class='product-section'
        data-category='".strtolower(str_replace(' ','',$currentCategory))."'>

        <h2 class='category-title'>
        ".$currentCategory."
        </h2>

        <div class='catalog'>
        ";
    }

?>

<div class="card">

<img
src="images/products/<?php echo htmlspecialchars($product['image']); ?>"
alt="<?php echo htmlspecialchars($product['name']); ?>">

<div class="info">

<h3><?php echo htmlspecialchars($product['name']); ?></h3>

<p><?php echo htmlspecialchars($product['description']); ?></p>

<div class="stock">

<?php echo htmlspecialchars($product['stock']); ?>

</div>

<div class="price">

KES <?php echo number_format($product['price']); ?>

</div>

<div class="buttons">

<a class="order"

href="https://wa.me/254741009502?text=I want to order <?php echo urlencode($product['name']); ?>">

Order on WhatsApp

</a>

</div>

</div>

</div>

<?php

}

if($currentCategory!=""){

    echo "</div></section>";

}

?>

</main>

<section class="filters">

<button class="active" data-filter="all">All</button>

<button data-filter="printersupplies">
Printer Supplies
</button>

<button data-filter="accessories">
Accessories
</button>

<button data-filter="storage">
Storage
</button>

<button data-filter="networking">
Networking
</button>

<button data-filter="power">
Power
</button>

<button data-filter="printers">
Printers
</button>

</section>
<footer>

<div>

<h3>HECOR Computers & Electronics</h3>
<a

href="https://wa.me/254741009502"

class="floating-whatsapp"

target="_blank">

💬

</a>
<button id="topBtn">

↑

</button>

<script src="js/catalog.js"></script>
<p>

Kisii Town • Uhuru Plaza Building

</p>

<p>

📞 +254 741 009 502

</p>

<p>

✉ enockmokaya35@gmail.com

</p>

</div>

<p class="copyright">

© 2026 HECOR Computers & Electronics

</p>

</footer>

<script src="js/catalog.js"></script>

</body>

</html>