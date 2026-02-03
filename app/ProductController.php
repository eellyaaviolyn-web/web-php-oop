<?php
require_once 'app/Database.php';
class ProductController
{
private $db;
public function __construct()
{
$this->db = Database::getInstance()->getConnection();
}
public function getProducts()
{
$result = mysqli_query($this->db, "Select * from products");
$products = [];
while ($product = mysqli_fetch_assoc($result)) {
$products[] = $product;
}
return $products;
}
// update data
public function updateProduct($data, $id)
{
// implementasi bug menggunakan this
$name = $this->filter($data['name']);
$price = $this->filter($data['price']);
// mencegah sqlinjek atau hacking
$sql = $this->db->prepare("UPDATE products SET name=?, price=? WHERE
id=?");
// melakukan manipulasi data dengan string dan integer
$sql->bind_param("sii", $name, $price, $id);
// membuat kondisi
if ($sql->execute()) {
if ($sql->affected_rows > 0) {
echo "<script>
alert('Product Upload Sucsess')
window.location.href='index.php';
</script>";
}else{
echo "<script>
<script>alert('Failed to update product!" . $sql->error . "')
window.location.href='edit-product.php?id=". $id ."';
</script>";
}
} 
}
// tambah data
public function createProduct($data)
{
// implementasi bug menggunakan this
$name = $this->filter($data['name']);
$price = $this->filter($data['price']);
// mencegah sqlinjek atau hak
$sql = $this->db->prepare("INSERT INTO products (name, price)values(?, 
?)");
// melakukan manipulasi data dengan string dan integer
$sql->bind_param("si", $name, $price);
// membuat kondisi
if ($sql->execute()) {
echo"<script>alert('Product created sucessfully!') 
window.location.href='index.php';
</script>";
} else { 
echo"<script>alert('Failed to create product!" . $sql->error . "')
window.location.href='create-product.php'; </script>";
}
}
// membuat fungsion untuk delete
public function deleteProduct($id)
{
$sql = $this->db->prepare("DELETE FROM products WHERE id=?");
$sql->bind_param("i", $id);
// membuat kondisi
if ($sql->execute()) {
echo"<script>alert('Product deleted sucessfully!')
window.location.href='index.php';
</script>";
}else{
echo"<script>alert('Failed to delete product!" .$sql->error."')
window.location.href='index.php';
</script>";
}
}
public function showProduct($id)
{
$sql = $this->db->prepare("SELECT * FROM products WHERE id=?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result()->fetch_assoc();
return $result;
}
// mencegah hack dan BUG
private function filter($input)
{
return htmlspecialchars(strip_tags($input));
}
}