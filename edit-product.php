<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membuat Aplikasi Sederhana Menggunakan PHP OOP, Mysql an
        Bootstraps</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-
rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <!-- menambah css dari datatable bootstrapp -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
</head>
<?php
require 'layout/header.php';
require_once 'app/ProductController.php';
$productController = new ProductController();
$productId = (int) $_GET['id'];
$getProduct = $productController->showProduct($productId);
// membuat kondisi jika tidak ada id
// cek hecked <script>alert('HACKED')</script>
if (!$getProduct) {
    echo "<script>
alert('Product Not Found Witd ID:" . $productId . "')
window.location.href='index.php';
</script>";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productController->updateProduct($_POST, $getProduct['id']);
}
?>
<div class="container mt-5">
    <h1>Latihan PHP OOP, Mysql dan Bootstraps</h1>
    <div class="card">
        <!-- menambah data card bootstrap -->
        <div class="card-header">
            <h5>Edit Product</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" id="createProduct">
                <div class="mb-3"><label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name"
                        id="name" value="<?= $getProduct['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price"
                        id="price" value="<?= $getProduct['price']; ?>" required min="0">
                </div>
            </form>
            <div class="float-end">
                <a href="index.php" class="btn btn-secondary">Back</a>
                <button type="submit" form="createProduct" class="btn btn-primary" name="submit">Edit</button>
            </div>
        </div>
    </div>
</div>
<?php
require 'layout/footer.php';
?>