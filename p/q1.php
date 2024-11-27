<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productsInput = $_POST['products'];
    $productsArray = array_map('trim', explode(',', $productsInput));
    $productsArray = array_unique($productsArray);
    sort($productsArray);

    echo "<h3>Sorted Product List:</h3><ul>";
    foreach ($productsArray as $product) {
        echo "<li>" . htmlspecialchars($product) . "</li>";
    }
    echo "</ul>";

    $fileName = 'products.txt';
    $existingProducts = file_exists($fileName) ? file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $combinedProducts = array_unique(array_merge($existingProducts, $productsArray));
    sort($combinedProducts);
    file_put_contents($fileName, implode(PHP_EOL, $combinedProducts) . PHP_EOL);
}
?>

<!DOCTYPE html>
<html>

<body>
    <form method="post">
        <label for="products">Enter product names (comma-separated):</label>
        <input type="text" id="products" name="products" required>
        <button type="submit">Submit</button>
    </form>
</body>

</html>