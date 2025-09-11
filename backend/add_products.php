<?php
include "db.php";
$name = $_POST['name'];
$desc = $_POST['description'];
$price = $_POST['price'];

$sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$desc', '$price')";
if ($conn->query($sql)) {
    header("Location: ../admin.html");
} else {
    echo "Error: " . $conn->error;
}
?>
