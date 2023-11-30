<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2196F3;
            color: #fff;
            text-align: center;
            padding: 1em;
        }
        nav {
            background-color: #3498db;
            padding: 1em;
            overflow: hidden;
        }
        nav a {
            float: left;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        nav a:hover {
            background-color: #ddd;
            color: #333;
        }
        
        .product-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 20px;
        }

        .product-image img {
            max-width: 40%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .product-details {
            flex: 1;
            padding: 0 20px;
        }

        .product-details h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <?php
        // Include database connection file
        include 'conn.php';

        // Assume you have the product ID from the URL
        $productId = isset($_GET['id']) ? $_GET['id'] : null;

        // Fetch product data based on the product ID
        $sql = "SELECT product_name, price, description, product_image FROM products WHERE product_id = $productId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row['product_name'];
            $price = $row['price'];
            $description = $row['description'];
            $productImage = ($row['product_image']);
        } else {
            // Product not found
            echo 'Product not found';
            exit;
        }
    ?>

    <header>
        <h1>Product Detail</h1>
        
    </header>

    
    <nav id="categories">
   
   </nav>

    <div class="product-container">
        <div class="product-image">
            <img src="data:image/jpeg;base64,<?php echo $productImage; ?>" alt="Product Image">
        </div>
        <div class="product-details">
            <h2><?php echo $productName; ?></h2>
            <p>Price: $<?php echo $price; ?></p>
            <p><?php echo $description; ?></p>
        </div>
    </div>

    <?php
        // Close the database connection
        $conn->close();
    ?>
</body>
</html>
