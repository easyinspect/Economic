<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 12:41.
 */

namespace Economic\Models\Components;

class ProductGroup
{
    /** @var int $productGroupNumber */
    public $productGroupNumber;
    /** @var string $name */
    public $name;
    /** @var string $products */
    public $products;
    /** @var string $salesAccounts */
    public $salesAccounts;
    /** @var string $self */
    public $self;

    public function __construct(int $productGroupNumber = null, string $name = null, string $products = null, string $salesAccounts = null, string $self = null)
    {
        $this->productGroupNumber = $productGroupNumber;
        $this->name = $name;
        $this->products = $products;
        $this->salesAccounts = $salesAccounts;
        $this->self = $self;
    }
}
