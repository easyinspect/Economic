<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class Inventory
{
    /** @var int $available */
    public $available;
    /** @var int $grossWeight */
    public $grossWeight;
    /** @var int $inStock */
    public $inStock;
    /** @var int $netWeight */
    public $netWeight;
    /** @var int $orderedByCustomers */
    public $orderedByCustomers;
    /** @var int $orderedFromSuppliers */
    public $orderedFromSuppliers;
    /** @var int $packageVolume */
    public $packageVolume;
    /** @var int $recommendedCostPrice */
    public $recommendedCostPrice;

    public function __construct(int $available = null, int $grossWeight = null, int $inStock = null, int $netWeight = null, int $orderedByCustomers = null, int $orderedFromSuppliers = null, int $packageVolume = null, int $recommendedPrice = null)
    {
        $this->available = $available;
        $this->grossWeight = $grossWeight;
        $this->inStock = $inStock;
        $this->netWeight = $netWeight;
        $this->orderedByCustomers = $orderedByCustomers;
        $this->orderedFromSuppliers = $orderedFromSuppliers;
        $this->packageVolume = $packageVolume;
        $this->recommendedCostPrice = $recommendedPrice;
    }
}
