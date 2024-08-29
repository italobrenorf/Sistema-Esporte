<?php

class Cart
{
  public function __construct()
  {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [
        'products' => [],
        'total' => 0
      ];
    }
  }

  public function add(Product $product)
  {
    $inCart = false;
    $this->setTotal($product);

    foreach ($this->getCart() as $index => $productInCart) {
      if ($productInCart->getId() === $product->getId()) {
        $quantity = $productInCart->getQuantity() + $product->getQuantity();
        $_SESSION['cart']['products'][$index]->setQuantity($quantity);
        $inCart = true;
        break;
      }
    }

    if (!$inCart) {
      $this->setProductsInCart($product);
    }
  }

  private function setProductsInCart($product)
  {
    $_SESSION['cart']['products'][] = $product;
  }

  private function setTotal(Product $product)
  {
    $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity();
  }

  public function remove(int $id)
  {
    foreach ($this->getCart() as $index => $product) {
      if ($product->getId() === $id) {
        $this->updateTotal($product, -1);
        $product->setQuantity($product->getQuantity() - 1);

        if ($product->getQuantity() <= 0) {
          unset($_SESSION['cart']['products'][$index]);
        }
      }
    }
  }

  public function updateQty($id, $qty)
  {
    foreach ($this->getCart() as $index => $product) {
      if ($product->getId() === (int)$id) {
        if ($product->getQuantity() === (int)$qty) {
          return;
        }

        $this->updateTotal($product, $qty - $product->getQuantity());
        $_SESSION['cart']['products'][$index]->setQuantity((int)$qty);

        if ($product->getQuantity() <= 0) {
          unset($_SESSION['cart']['products'][$index]);
        }
      }
    }
  }

  private function updateTotal(Product $product, $qtyDifference)
  {
    $_SESSION['cart']['total'] += $product->getPrice() * $qtyDifference;
  }

  public function getCart()
  {
    return $_SESSION['cart']['products'] ?? [];
  }

  public function getTotal()
  {
    return $_SESSION['cart']['total'] ?? 0;
  }

  public function clear()
  {
    $_SESSION['cart'] = [
      'products' => [],
      'total' => 0
    ];
  }
}
