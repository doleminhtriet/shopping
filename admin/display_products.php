<?php
error_reporting(E_ALL);


include "../conn.php"; // Include the database connection script

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Product List</h2>";
    echo "<table border='1'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Price</th>";
    echo "<th>Description</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
