<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // ✅ Add Product
    if ($action == "add") {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO products (name, price, stock) VALUES ('$name', '$price', '$stock')";
        if ($conn->query($sql) === TRUE) {
            echo "✅ Product added successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }

    // ✅ Edit Product
    elseif ($action == "edit") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $sql = "UPDATE products SET name='$name', price='$price', stock='$stock' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "✅ Product updated successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }

    // ✅ Delete Product
    elseif ($action == "delete") {
        $id = $_POST['id'];

        $sql = "DELETE FROM products WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "✅ Product deleted successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }

    // ✅ Update Order
    elseif ($action == "update_order") {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $sql = "UPDATE orders SET status='$status' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "✅ Order updated successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }

    else {
        echo "❌ Invalid action!";
    }
}
?>
