<?php
require_once 'Product.php';
class Cart
{
    private $cart;

    public function __construct()
    {
        $this->cart = [];
    }

    public function addItem(Product $product, $quantity)
    {
        $productId = $product->getId();

        if(isset($this->cart[$productId]))
        {
            if(!($this->cart[$productId]['quantity']+$quantity > $product->getQuantity()))
                $this->cart[$productId]['quantity']+=$quantity;
        }
        else
        {
            $this->cart[$productId] = [
                'quantity' => $quantity,
                'product' => $product, // Use the existing instance
            ];
        }
    }

    public function updateQuantity($productId, $quantity): void
    {
        if(isset($this->cart[$productId]))
        {
            $Product = new Product($productId);
            if(!($quantity > $Product->getQuantity() || $quantity < 1))
                $this->cart[$productId]['quantity']=$quantity;
        }
    }

    public function removeItem($productId)
    {
        if(isset($this->cart[$productId]))
        {
            unset($this->cart[$productId]);
        }
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach($this->cart as $item)
        {
            $total += $item['product']->getNettoPrice() * $item['quantity'];
        }
        return $total;
    }

    public function save(): void
    {
        $db = Database::getInstance();
        if(count($this->cart) == 0)
            echo "Can't save empty cart!";
        else
        {
            echo "This function is not yet implemented, sorry!";
        }
    }

    public function __toString()
    {
        return 'xd';
    }

    public function getItems():array
    {
        return $this->cart;
    }
}
?>