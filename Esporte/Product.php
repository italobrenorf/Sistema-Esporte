<?php

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private int $quantity;
    private $url;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
