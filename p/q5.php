<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => ["name" => "Laptop", "price" => 1200],
    2 => ["name" => "Phone", "price" => 800],
    3 => ["name" => "Headphones", "price" => 150],
    4 => ["name" => "Smartwatch", "price" => 300],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $productId = $_POST['product_id'];
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
    } elseif (isset($_POST['remove'])) {
        $productId = $_POST['product_id'];
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]--;
            if ($_SESSION['cart'][$productId] <= 0) {
                unset($_SESSION['cart'][$productId]);
            }
        }
    }
}

$totalCost = 0;
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Products</h2>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $id => $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td>$<?php echo number_format($product['price'], 2); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                        <button type="submit" name="add">Add to Cart</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Shopping Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
                <tr>
                    <td><?php echo htmlspecialchars($products[$productId]['name']); ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>$<?php echo number_format($products[$productId]['price'], 2); ?></td>
                    <td>$<?php echo number_format($products[$productId]['price'] * $quantity, 2); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <button type="submit" name="remove">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php $totalCost += $products[$productId]['price'] * $quantity; ?>
            <?php endforeach; ?>
        </table>
        <h3>Total Cost: $<?php echo number_format($totalCost, 2); ?></h3>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>

</html>