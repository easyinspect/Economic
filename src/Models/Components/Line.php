<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 27-09-2017
 * Time: 13:50.
 */

namespace Economic\Models\Components;

class Line
{
    /** @var string $description */
    public $description;
    /** @var int $quantity */
    public $quantity;
    /** @var int $discountPercentage */
    public $discountPercentage;
    /** @var float $unitNetPrice */
    public $unitNetPrice;
    /** @var Product $product */
    public $product;

    public function __construct(string $productNumber, string $name, int $quantity, float $price, float $discountPercentage = null)
    {
        $this->unitNetPrice = $price;
        $this->discountPercentage = $discountPercentage;
        $this->quantity = $quantity;
        $this->description = $name;
        $this->product = new Product($productNumber);
    }
}
