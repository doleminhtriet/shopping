<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
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
        .products {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around; /* Adjust as needed */
        }

        .products li {
            width: calc(30% - 20px); /* 3 columns with 20px spacing */
            margin: 10px;
            box-sizing: border-box;
        }

        .products a {
            text-decoration: none;
            color: #333;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
        }

        img {
            max-width: 100%;
            height: auto;
        }


    </style>
</head>
<body>



<header>
    <h1>Shopping</h1>
</header>

<nav id="categories">
   
</nav>

<div class="products" id="products">
    
</div>




<script>
        //initial loading website
        window.onload = function() {
            fetchProducts();
            fetchCategories();
        };

        //load data from get_products.php
        function fetchProducts() {
        fetch('admin/get_products.php')
            .then(response => {
                // Log the raw response for debugging
                console.log('Raw response:', response);
                return response.json();
            })
            .then(data => {
                displayProduct(data);
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
        }


        //Fetch product by Category ID
        function fetchProductByID(CategoryID) {
        fetch('admin/getProductByCategory.php?CategoryID='+CategoryID)
            .then(response => {
                // Log the raw response for debugging
                console.log('Raw response:', response);
                return response.json();
            })
            .then(data => {
                displayProduct(data);
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
        }

        function displayProduct(products) {
            const productsContainer = document.getElementById('products');
            productsContainer.innerHTML = '';

            const productList = document.createElement('ul');
            productList.className = 'products';

            products.forEach(product => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <a href=UI_productDetail.php?id=${product.product_id}>
                        <img src="data:image/jpeg;base64,${product.product_image}" alt="Product Image" style="max-width:100px; max-height:100px;">
                        <h4>${product.product_name}</h4>
                        <p>Price: $${product.price}</p>
                    </a>
                `;

        productList.appendChild(listItem);
    });

    productsContainer.appendChild(productList);
        }

        //load data category from get_Category.php
        function fetchCategories() {
        fetch('admin/get_Category.php')
            .then(response => response.json())
            .then(data => {
                displayCategories(data);
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    }

        //show category on HTML
        function displayCategories(categories) {
            const categoriesContainer = document.getElementById('categories');
            categoriesContainer.innerHTML = '';

            categories.forEach(category => {
                const categoryLink = document.createElement('a');
                categoryLink.href = `javascript:void(0);`;
                categoryLink.textContent = category.category_name;
                
                 // Attach a click event to each category link
            categoryLink.addEventListener('click', function () {
                fetchProductByID(category.category_id); // Load products for the selected category
                //alert(category.category_id);
            });
                categoriesContainer.appendChild(categoryLink);
            });
        }


        


    </script>


</body>
</html>
