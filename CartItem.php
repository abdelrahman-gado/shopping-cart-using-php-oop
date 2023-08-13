<?php

require_once __DIR__ . "/Product.php";

class CartItem
{
    public function __construct(
        private Product $product,
        private int $quantity
    ) {
    }

    public function increaseQuantity(int $amount = 1): void
    {
        $currentAvailableQuantity = $this->product->getAvailableQuantity();

        if ($currentAvailableQuantity >= $amount) {

            $this->quantity += $amount;
            $this->product->setAvailableQuantity($currentAvailableQuantity - $amount);

        } else {

            throw new Exception("There is no enough quantity from this product");
        }

    }

    public function decreaseQuantity(int $amount = 1): void
    {
        if ($this->quantity > 1 && $amount < $this->quantity) {
            $this->quantity -= $amount;
            $currentAvailableQuantity = $this->product->getAvailableQuantity();
            $this->product->setAvailableQuantity($currentAvailableQuantity + $amount);
        } else {
            throw new Exception("The Quantity shouldn't be less than 1");
        }
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}