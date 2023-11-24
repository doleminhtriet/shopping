<?php
// Include your database connection file
include '../conn.php';

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product data based on the product ID
    $sql = "SELECT product_name, price, description, product_image FROM products WHERE product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Adjust this based on your actual data structure
        $row = $result->fetch_assoc();
        $productData = [
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'product_image' => $row['product_image']
        ];

        // Return product data as JSON
        header('Content-Type: application/json');
        echo json_encode($productData);
    } else {
        // Product not found
        http_response_code(404);
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    // Invalid request, product ID not provided
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
