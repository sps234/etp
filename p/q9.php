<?php

// Base class: Product
class Product
{
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    // Method to calculate the total cost of the product
    public function calculateTotalCost()
    {
        return $this->price * $this->quantity;
    }
}

// Derived class: DiscountedProduct
class DiscountedProduct extends Product
{
    // Method to calculate total cost with a discount if applicable
    public function calculateTotalCostWithDiscount()
    {
        $totalCost = $this->calculateTotalCost();
        if ($totalCost > 100) {
            $totalCost *= 0.9; // Apply a 10% discount
        }
        return $totalCost;
    }
}

// Example usage
$product = new DiscountedProduct("Gaming Mouse", 45, 3);

echo "<h3>Product Details:</h3>";
echo "Name: " . htmlspecialchars($product->name) . "<br>";
echo "Price: $" . number_format($product->price, 2) . "<br>";
echo "Quantity: " . $product->quantity . "<br>";

echo "<h3>Cost Calculation:</h3>";
echo "Total Cost (Before Discount): $" . number_format($product->calculateTotalCost(), 2) . "<br>";
echo "Total Cost (After Discount, if applicable): $" . number_format($product->calculateTotalCostWithDiscount(), 2) . "<br>";
?>