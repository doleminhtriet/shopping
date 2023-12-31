<?php


include "../conn.php"; // Include the database connection script

header('Content-Type: application/json');


// get all category
$sql = "SELECT * FROM category";
$result = $conn->query($sql);

// Check if there are results
if ($result) {
    // Fetch and encode the results as JSON
    $category = array();
    while ($row = $result->fetch_assoc()) {
        $category[] = $row;
    }
    echo json_encode($category);
} else {
    echo json_encode(array('error' => 'Error executing the query: ' . $conn->error));
}

$conn->close();
?>
