<?php

require_once __DIR__ . "/Cart.php";
require_once __DIR__ . "/CartItem.php";

class Product
{
    public function __construct(
        private int $id,
        private string $name,
        private float $price,
        private int $availableQuantity
    ) {
    }

    public function addToCart(Cart $cart, int $quantity): CartItem
    {
        return $cart->addProduct($this, $quantity);
    }

    public function removeFromCart(Cart $cart): Product
    {
        return $cart->removeProduct($this);
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function setAvailableQuantity($quantity): void
    {
        $this->availableQuantity = $quantity;
    }
}