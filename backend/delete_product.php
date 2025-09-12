<?php
include __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);

    // Delete image file if exists
    $sql_img = "SELECT image FROM products WHERE id=$id";
    $result_img = $conn->query($sql_img);
    if($result_img->num_rows > 0){
        $row = $result_img->fetch_assoc();
        if(file_exists($row['image'])){
            unlink($row['image']);
        }
    }

    // Delete product
    $sql = "DELETE FROM products WHERE id=$id";
    if($conn->query($sql) === TRUE){
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
    exit;
}

// GET request → return JSON list of products
header('Content-Type: application/json');
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);

$products = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $products[] = $row;
    }
}

echo json_encode($products);
$conn->close();
?>
