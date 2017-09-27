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
    public $productNumber;

    public function __construct($quantityNumber, $productNumber)
    {
        $this->quantity = $quantityNumber;
        (object)$this->productNumber = $productNumber;
    }

}