<?php
include 'config.php';

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    // Get image name before deleting
    $stmt = $mysqli->prepare("SELECT image FROM products WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Delete image file if it exists
    if($product && !empty($product['image'])){

        $imagePath = "images/products/".$product['image'];

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }

    // Delete product
    $stmt = $mysqli->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        header("Location: admin_products.php");
        exit();
    }else{
        echo "Error deleting product.";
    }

}else{
    header("Location: admin_products.php");
    exit();
}
?>