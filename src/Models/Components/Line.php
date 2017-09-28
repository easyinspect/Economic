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
    public $quantity;
    public $product;

    public function __construct($quantityNumber, $productNumber)
    {
        $this->quantity = $quantityNumber;
        $this->product = new Product($productNumber);
    }

}