<?php
include "db.php";
$id = $_POST['id'];
$name = $_POST['name'];
$desc = $_POST['description'];
$price = $_POST['price'];

$sql = "UPDATE products SET name='$name', description='$desc', price='$price' WHERE id=$id";
if ($conn->query($sql)) {
    echo "Product updated!";
} else {
    echo "Error: " . $conn->error;
}
?>
