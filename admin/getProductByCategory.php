<?php
// Include  database connection file
include '../conn.php';

// Check if the CategoryID is provided in the URL
if (isset($_GET['CategoryID'])) {
    $CategoryID = $_GET['CategoryID'];

    // Fetch product data based on the CategoryID
    $sql = "SELECT product_name, price, description, product_image FROM products WHERE CategoryID = $CategoryID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $productsData = []; // Initialize an array to store multiple products

        // Iterate through the result set
        while ($row = $result->fetch_assoc()) {
            // Adjust this based on your actual data structure
            $productData = [
                'product_name' => $row['product_name'],
                'price' => $row['price'],
                'description' => $row['description'],
                'product_image' => $row['product_image']
            ];

            // Add the current product data to the array
            $productsData[] = $productData;
        }

        // Return product data as JSON
        header('Content-Type: application/json');
        echo json_encode($productsData);
    } else {
        // Products not found
        http_response_code(404);
        echo json_encode(['error' => 'Products not found']);
    }
} else {
    // Invalid request, CategoryID not provided
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
