<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\ProductGroup\Accrual;

class ProductGroup
{
    /** @var Accrual $accrual */
    private $accrual;
    /** @var bool $inventoryEnabled */
    private $inventoryEnabled;
    /** @var string $name */
    private $name;
    /** @var int $productGroupNumber */
    private $productGroupNumber;
    /** @var string $products */
    private $products;
    /** @var string $salesAccounts */
    private $salesAccounts;
    /** @var string $self */
    private $self;

    /** @var Economic $api */
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }


}
