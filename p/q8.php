<?php

// Multi-dimensional array to store product details
$products = [
    [
        "name" => "Laptop",
        "price" => 1200,
        "stock" => 10
    ],
    [
        "name" => "Phone",
        "price" => 800,
        "stock" => 5
    ],
    [
        "name" => "Headphones",
        "price" => 150,
        "stock" => 20
    ],
    [
        "name" => "Smartwatch",
        "price" => 300,
        "stock" => 8
    ]
];

// Function to list all products
function listProducts($products)
{
    echo "<h3>Available Products:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Stock</th></tr>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>$" . number_format($product['price'], 2) . "</td>";
        echo "<td>" . $product['stock'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Function to search for a product by name
function searchProduct($products, $productName)
{
    foreach ($products as $product) {
        if (strcasecmp($product['name'], $productName) == 0) {
            echo "<p><strong>Product Found:</strong> " . htmlspecialchars($product['name']) . "<br>";
            echo "Price: $" . number_format($product['price'], 2) . "<br>";
            echo "Stock: " . $product['stock'] . "</p>";
            return;
        }
    }
    echo "<p>Product not found: " . htmlspecialchars($productName) . "</p>";
}

// Handle search form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'])) {
    $searchedProduct = trim($_POST['product_name']);
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Simple E-Commerce Website</h2>

    <!-- Display all products -->
    <?php listProducts($products); ?>

    <!-- Search form -->
    <h3>Search for a Product</h3>
    <form method="post">
        <label for="product_name">Enter Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <button type="submit">Search</button>
    </form>

    <!-- Display search results -->
    <?php
    if (isset($searchedProduct)) {
        searchProduct($products, $searchedProduct);
    }
    ?>
</body>

</html>