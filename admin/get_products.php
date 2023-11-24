<?php


include "../conn.php"; // Include the database connection script

header('Content-Type: application/json');



$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if there are results
if ($result) {
    // Fetch and encode the results as JSON
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(array('error' => 'Error executing the query: ' . $conn->error));
}

$conn->close();
?>
