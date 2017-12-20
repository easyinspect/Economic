<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 21-09-2017
 * Time: 11:04.
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Filter;
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

    /** @var Economic $economic */
    private $economic;

    /**
     * ProductGroup constructor
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transforms stdClass object into ProductGroup
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return ProductGroup
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $productGroup = new self($economic);

        $productGroup->setAccrual($stdClass->accrual ?? null);
        $productGroup->setProductGroupNumber($stdClass->productGroupNumber);
        $productGroup->setInventoryEnabled($stdClass->inventoryEnabled ?? null);
        $productGroup->setName($stdClass->name);
        $productGroup->setProducts($stdClass->products);
        $productGroup->setSalesAccounts($stdClass->salesAccounts);
        $productGroup->setSelf($stdClass->self);

        return $productGroup;
    }

    /**
     * Retrieves a collection of ProductGroups
     * @param Filter $filter
     * @return ProductGroup
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/product-groups?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/product-groups?', $this);
        }
    }

    /**
     * Retrieves single ProductGroup by productGroupNumber
     * @param int $productGroupNumber
     * @return ProductGroup
     */
    public function get(int $productGroupNumber)
    {
        return self::transform($this->economic, $this->economic->get('/product-groups/'.$productGroupNumber));
    }

    /**
     * Retrieves a collection of sales accounts that belongs to the given ProductGroup
     * @return Accrual
     */
    public function salesAccounts()
    {
        return $this->economic->collection('/product-groups/'.$this->getProductGroupNumber().'/sales-accounts?', new Accrual());
    }

    /**
     * Retrieves a collection of products that belongs to the given ProductGroup
     * @return Product
     */
    public function products()
    {
        return $this->economic->collection('/product-groups/'.$this->getProductGroupNumber().'/products?', new Product($this->economic));
    }

    // Getters & Setters

    /**
     * @return Accrual
     */
    public function getAccrual() : ?Accrual
    {
        return $this->accrual;
    }

    /**
     * @param \stdClass $accrual
     * @return ProductGroup
     */
    public function setAccrual(\stdClass $accrual = null)
    {
        if (isset($accrual)) {
            $this->accrual = new Accrual(
                $accrual->accountingYears ?? null,
                $accrual->accountNumber ?? null,
                $accrual->accountsSummed ?? null,
                $accrual->accountType ?? null,
                $accrual->balance ?? null,
                $accrual->barred ?? null,
                $accrual->blockDirectEntries ?? null,
                $accrual->contraAccount ?? null,
                $accrual->debitCredit ?? null,
                $accrual->draftBalance ?? null,
                $accrual->name ?? null,
                $accrual->totalFromAccount ?? null,
                $accrual->vatAccount ?? null
            );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductGroup
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function getInventoryEnabled() : ?bool
    {
        return $this->inventoryEnabled;
    }

    /**
     * @param bool $inventoryEnabled
     * @return ProductGroup
     */
    public function setInventoryEnabled(bool $inventoryEnabled = null)
    {
        $this->inventoryEnabled = $inventoryEnabled;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductGroupNumber() : ?int
    {
        return $this->productGroupNumber;
    }

    /**
     * @param int $productGroupNumber
     * @return ProductGroup
     */
    public function setProductGroupNumber(int $productGroupNumber)
    {
        $this->productGroupNumber = $productGroupNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getProducts() : ?string
    {
        return $this->products;
    }

    /**
     * @param string $products
     * @return ProductGroup
     */
    public function setProducts(string $products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalesAccounts() : ?string
    {
        return $this->salesAccounts;
    }

    /**
     * @param string $salesAccounts
     * @return ProductGroup
     */
    public function setSalesAccounts(string $salesAccounts)
    {
        $this->salesAccounts = $salesAccounts;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelf() : ?string
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return ProductGroup
     */
    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }
}
