<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Product
{
    /** @var int $productNumber */
    public $productNumber;

    public function __construct(string $productNumber)
    {
        $this->productNumber = $productNumber;
    }

}