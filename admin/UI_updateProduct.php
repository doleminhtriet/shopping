<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/adminStyle.css">

   
</head>
<body>

 

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
            $productName = $row['product_name'];
            $price = $row['price'];
            $description = $row['description'];
            $img= $row['product_image'];
            //echo $row['product_name'];


        
 
?>

        <header>
            <h1>Update Product Info</h1>
        </header>

        <nav>
            <a href="index.php" class="products">Products</a>
            <a href="Category.php" class="category">Category</a>
        </nav>
    
    <div class="container">
        <form action="updateProduct.php" method="post" enctype="multipart/form-data">
        
            <input type="hidden" id="product_id" name="product_id" value=<?php echo $productId; ?> >
            
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required value='<?php echo $row['product_name']; ?>'>

            <label for="price">Price:</label>
            <input type="number" name="price" required value=<?php echo $price; ?> > 

            <label for="description">Description:</label>
            <textarea name="description" required><?php echo $description; ?></textarea>
            <?php if (!empty($img)): ?>

            <img src="data:image/jpeg;base64,<?php echo ($img); ?>" alt="Product Image" style="max-width:100px; max-height:100px;>

            <?php endif; ?>
            <label for="picture"></label>
            <label for="picture">Picture:</label>
            <input type="file" name="picture" accept="image/*" required>

            
            <br><br>
            <input type="submit" value="Update Product">

        </form>
   
    </div>





<?php
        
     

       
    } else {
        // Product not found
        http_response_code(404);
    }
} else {
    // Invalid request, product ID not provided
    http_response_code(400);
}

// Close the database connection
$conn->close();
?>


</body>
</html>
