<?php

require_once __DIR__ . "/Product.php";
require_once __DIR__ . "/Cart.php";
require_once __DIR__ . "/CartItem.php";

$product1 = new Product(1, 'IPhone', 2500, 10);
$product2 = new Product(2, 'M2 SSD', 400, 10);
$product3 = new Product(3, 'Samsung Galaxy S20', 3200, 10);

$cart = new Cart();

$cartItem1 = $cart->addProduct($product1, 1);
$cartItem2 = $product2->addToCart($cart, 1);

echo "Number of Items is cart: ";
echo $cart->getTotalQuantity() . PHP_EOL; // 2

echo "Total price of items in cart: ";
echo $cart->getTotalSum() . PHP_EOL; //2900

$cartItem2->increaseQuantity();
$cartItem2->increaseQuantity();

echo "Number of Items is cart: ";
echo $cart->getTotalQuantity() . PHP_EOL; // 4

echo "Total price of items in cart: ";
echo $cart->getTotalSum() . PHP_EOL; // 3700
