<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 27-09-2017
 * Time: 13:50
 */

namespace Economic\Models\Components;


class Line
{
    public $description;
    public $quantity;
    public $unitNetPrice;
    public $product;
    public $discountPercentage;

    public function __construct($productNumber, $name, $quantity, $price, $discountPercentage)
    {
        $this->unitNetPrice = $price;
        $this->quantity = $quantity;
        $this->description = $name;
        $this->discountPercentage = $discountPercentage;
        $this->product = new Product($productNumber);
    }
}