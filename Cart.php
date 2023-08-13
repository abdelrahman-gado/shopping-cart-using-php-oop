<?php

require_once __DIR__ . "/Product.php";
require_once __DIR__ . "/CartItem.php";

class Cart
{
    private array $cartItems = [];

    public function addProduct(Product $product, int $quantity): CartItem
    {
        $currentAvailableQuantity = $product->getAvailableQuantity();

        if ($currentAvailableQuantity >= $quantity) {

            $product->setAvailableQuantity($currentAvailableQuantity - $quantity);
            $cartItem = new CartItem($product, $quantity);
            $this->addCartItem($cartItem);

            return $cartItem;

        } else {

            throw new Exception("There is no enough quantity from this product");
        }
    }

    private function addCartItem(CartItem $item): void
    {
        $productId = $item->getProduct()->getId();

        // check if the product exists, if it exists, 
        // increase the quantity of the cartItem
        if (array_key_exists($productId, $this->cartItems)) {

            $amount = $item->getQuantity();

            ($this->cartItems[$productId])->increaseQuantity($amount);

        } else {
            $this->cartItems[$productId] = $item;
        }
    }


    public function removeProduct(Product $product): Product
    {
        $productId = $product->getId();

        if (!array_key_exists($productId, $this->cartItems)) {
            throw new Exception("This product is not found in cart");
        }

        $deletedProduct = $this->cartItems[$productId]->getProduct();

        // Increase the the product availableQuantity again before we delete the cart item from cart
        $deletedCartItemQuantity = $this->cartItems[$productId]->getQuantity();
        $currentProductAvailableQuantity = $deletedProduct->getAvailableQuantity();
        $deletedProduct->setAvailableQuantity($currentProductAvailableQuantity + $deletedCartItemQuantity);

        unset($this->cartItems[$productId]);

        return $deletedProduct;
    }


    public function getTotalQuantity(): int
    {
        return array_reduce($this->cartItems, function ($carry, $item) {
            $carry += $item->getQuantity();
            return $carry;
        }, 0);
    }

    public function getTotalSum(): float
    {
        return array_reduce($this->cartItems, function ($carry, $item) {
            $quantity = $item->getQuantity();
            $price = $item->getProduct()->getPrice();
            $carry += ($quantity * $price);
            return $carry;
        }, 0.0);
    }


    public function getItems(): array
    {
        return $this->cartItems;
    }
}