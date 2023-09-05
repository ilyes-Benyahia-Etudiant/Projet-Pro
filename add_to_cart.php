<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item"])) {
    $item = $_POST["item"];

    // Initialize cart if not exists
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Check if item is already in the cart
    $itemIndex = -1;
    foreach ($_SESSION["cart"] as $index => $cartItem) {
        if ($cartItem["id"] === $item["id"]) {
            $itemIndex = $index;
            break;
        }
    }

    if ($itemIndex !== -1) {
        // Update quantity if item already in cart
        $_SESSION["cart"][$itemIndex]["quantity"] += 1;
    } else {
        // Add new item to cart
        $item["quantity"] = 1;
        $_SESSION["cart"][] = $item;
    }

    echo "Item added to cart successfully!";
} else {
    echo "Invalid request.";
}
?>
