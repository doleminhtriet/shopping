<?php
// Include the database connection file
include '../conn.php';

// Check if the product ID is provided in the query parameters
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // SQL query to delete the product
    $deleteSql = "DELETE FROM products WHERE product_id = $productId";
    
    if ($conn->query($deleteSql)) {
        // Product deleted successfully
        echo json_encode(array('success' => 'Product deleted successfully.'));
    } else {
        // Error deleting the product
        echo json_encode(array('error' => 'Error deleting the product: ' . $conn->error));
    }
} else {
    // Product ID not provided in the query parameters
    echo json_encode(array('error' => 'Product ID not provided.'));
}

// Close the database connection
$conn->close();
?>