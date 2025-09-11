<?php
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "add") {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $image = '';
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
            $targetDir = __DIR__ . '/../uploads/';
            if(!is_dir($targetDir)){
                mkdir($targetDir, 0777, true);
            }
            $filename = basename($_FILES['photo']['name']);
            $targetFile = $targetDir . $filename;

            if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)){
                $image = 'uploads/' . $filename;
            } else {
                echo "File upload failed!";
            }
        }

        $created_at = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO products (name, price, stock, image, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdiss", $name, $price, $stock, $image, $created_at);

        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    elseif ($action == "edit") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=? WHERE id=?");
        $stmt->bind_param("sdii", $name, $price, $stock, $id);

        if ($stmt->execute()) {
            echo "Product updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    elseif ($action == "delete") {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Product deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    elseif ($action == "update_order") {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "Order updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    else {
        echo "Invalid action!";
    }
}

$conn->close();
?>
