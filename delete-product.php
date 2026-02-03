<?php
require_once 'app/ProductController.php';
$productController = new ProductController();
$productId = (int) $_GET['id'];
$getProduct = $productController->showProduct($productId);
// membuat kondisi jika tidak ada id
// cek hecked <script>alert('HACKED')</script>
if (!$getProduct) {
    echo "Product tidak ditemukan:" . $productId;
    exit;
} else {
    $productController->deleteProduct($getProduct['id']);
}