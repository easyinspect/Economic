<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 10:45.
 */

namespace Economic\Models;

use Economic\Filter;
use Economic\Economic;
use Economic\Models\Components\Unit;
use Economic\Models\Components\Invoices;
use Economic\Models\Components\Inventory;
use Economic\Validations\ProductValidator;
use Economic\Models\Components\ProductGroup;
use Economic\Models\Components\DepartmentalDistribution;

class Product
{
    /** @var string $barCode */
    private $barCode;
    /** @var bool $barred */
    private $barred;
    /** @var float $costPrice */
    private $costPrice;
    /** @var float $salesPrice */
    private $salesPrice;
    /** @var float $recommendedPrice */
    private $recommendedPrice;
    /** @var string $description */
    private $description;
    /** @var string $lastUpdated */
    private $lastUpdated;
    /** @var string $name */
    private $name;
    /** @var ProductGroup $productGroup */
    private $productGroup;
    /** @var Invoices $invoices */
    private $invoices;
    /** @var int $productNumber */
    private $productNumber;
    /** @var Unit $units */
    private $unit;

    // Module objects
    /** @var DepartmentalDistribution $departmentalDistribution */
    private $departmentalDistribution;
    /** @var Inventory $inventory */
    private $inventory;

    /** @var string $self */
    private $self;

    /** @var Economic $economic */
    private $economic;

    /**
     * Product constructor.
     * @param Economic $economic
     */
    public function __construct(Economic $economic)
    {
        $this->economic = $economic;
    }

    /**
     * Transform stdClass object into Product.
     * @param Economic $economic
     * @param \stdClass $stdClass
     * @return Product
     */
    public static function transform(Economic $economic, \stdClass $stdClass)
    {
        $product = new self($economic);

        $product->setBarCode($stdClass->barCode ?? null);
        $product->setBarred($stdClass->barred);
        $product->setCostPrice($stdClass->costPrice ?? null);
        $product->setSalesPrice($stdClass->salesPrice);
        $product->setRecommendedPrice($stdClass->recommendedPrice);
        $product->setDescription($stdClass->description ?? null);
        $product->setLastUpdated($stdClass->lastUpdated);
        $product->setName($stdClass->name);
        $product->setProductGroup($stdClass->productGroup);
        $product->setProductNumber($stdClass->productNumber);
        $product->setUnit($stdClass->unit ?? null);
        $product->setDepartmentalDistribution($stdClass->departmentalDistribution ?? null);
        $product->setInventory($stdClass->inventory ?? null);
        $product->setInvoices($stdClass->invoices);
        $product->setSelf($stdClass->self);

        return $product;
    }

    /**
     * Retrieves a collection of Products.
     * @param Filter $filter
     * @return Product
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->economic->collection('/products?'.$filter->filter().'&', $this);
        } else {
            return $this->economic->collection('/products?', $this);
        }
    }

    /**
     * Retrieves a single Product by its ID.
     * @param int $id
     * @return Product
     */
    public function get(int $id)
    {
        return self::transform($this->economic, $this->economic->get('/products/'.$id));
    }

    /**
     * Deletes a Product
     * Requires Product's get(id) method in order to perform this.
     */
    public function delete()
    {
        return $this->economic->delete('/products/'.$this->getProductNumber());
    }

    /**
     * Creates a Product.
     * @return Product
     */
    public function create()
    {
        $data = (object) [
            'barCode' => $this->getBarCode(),
            'barred' => $this->getBarred(),
            'costPrice' => $this->getCostPrice(),
            'salesPrice' => $this->getSalesPrice(),
            'recommendedPrice' => $this->getRecommendedPrice(),
            'description' => $this->getDescription(),
            'lastUpdated' => $this->getLastUpdated(),
            'name' => $this->getName(),
            'productGroup' => $this->getProductGroup(),
            'productNumber' => $this->getProductNumber(),
            'unit' => $this->getUnit(),
            'departmentalDistribution' => $this->getDepartmentalDistribution(),
            'inventory' => $this->getInventory(),
        ];

        $this->economic->cleanObject($data);

        $validator = ProductValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->economic, $this->economic->create('/products', $data));
    }

    /**
     * Updates a Product.
     * @return Product
     */
    public function update()
    {
        $data = (object) [
            'barCode' => $this->getBarCode(),
            'barred' => $this->getBarred(),
            'costPrice' => $this->getCostPrice(),
            'salesPrice' => $this->getSalesPrice(),
            'recommendedPrice' => $this->getRecommendedPrice(),
            'description' => $this->getDescription(),
            'lastUpdated' => $this->getLastUpdated(),
            'name' => $this->getName(),
            'productGroup' => $this->getProductGroup(),
            'productNumber' => $this->getProductNumber(),
            'unit' => $this->getUnit(),
            'departmentalDistribution' => $this->getDepartmentalDistribution(),
            'inventory' => $this->getInventory(),
        ];

        $this->economic->cleanObject($data);

        return self::transform($this->economic, $this->economic->update('/products/'.$this->getProductNumber(), $data));
    }

    // Getters & Setters

    /**
     * @return Invoices
     */
    public function getInvoices() : ?Invoices
    {
        return $this->invoices;
    }

    /**
     * @param Invoices $invoices
     * @return $this
     */
    public function setInvoices($invoices = null)
    {
        if (isset($invoices)) {
            $this->invoices = new Invoices($invoices->booked, $invoices->drafts);
        }

        return $this;
    }

    /**
     * @return DepartmentalDistribution
     */
    public function getDepartmentalDistribution() : ?DepartmentalDistribution
    {
        return $this->departmentalDistribution;
    }

    /**
     * @param DepartmentalDistribution $departmentalDistribution
     * @return $this
     */
    public function setDepartmentalDistribution($departmentalDistribution = null)
    {
        if (isset($departmentalDistribution)) {
            $this->departmentalDistribution = new DepartmentalDistribution($departmentalDistribution->departmentalDistributionNumber, $departmentalDistribution->distributionType, $departmentalDistribution->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getDepartmentalDistributionNumber() : ?int
    {
        if (isset($this->departmentalDistribution)) {
            return $this->departmentalDistribution->departmentalDistributionNumber;
        }

        return null;
    }

    /**
     * @param int $departmentalDistributionNumber
     * @return $this
     */
    public function setDepartmentalDistributionNumber(int $departmentalDistributionNumber)
    {
        if (isset($this->departmentalDistribution)) {
            $this->departmentalDistribution->departmentalDistributionNumber = $departmentalDistributionNumber;
        } else {
            $this->departmentalDistribution = $this->economic->setClass('DepartmentalDistribution', 'departmentalDistributionNumber');
            $this->departmentalDistribution->departmentalDistributionNumber = $departmentalDistributionNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getDepartmentalDistributionType() : ?string
    {
        if (isset($this->departmentalDistribution)) {
            return $this->departmentalDistribution->distributionType;
        }

        return null;
    }

    /**
     * @param string $distributionType
     * @return $this
     */
    public function setDepartmentalDistributionType(string $distributionType)
    {
        if (isset($this->departmentalDistribution)) {
            $this->departmentalDistribution->distributionType = $distributionType;
        } else {
            $this->departmentalDistribution = $this->economic->setClass('DepartmentalDistribution', 'distributionType');
            $this->departmentalDistribution->distributionType = $distributionType;
        }

        return $this;
    }

    /**
     * @return Inventory
     */
    public function getInventory() : ?Inventory
    {
        return $this->inventory;
    }

    /**
     * @param Inventory $inventory
     * @return $this
     */
    public function setInventory($inventory = null)
    {
        if (isset($inventory)) {
            $this->inventory = new Inventory($inventory->available, $inventory->grossWeight, $inventory->inStock, $inventory->netWeight, $inventory->orderedByCustomers, $inventory->orderedFromSuppliers, $inventory->packageVolume, $inventory->recommendedPrice);
        }

        return $this;
    }

    /**
     * @return Unit
     */
    public function getUnit() : ?Unit
    {
        return $this->unit;
    }

    /**
     * @param Unit $unit
     * @return $this
     */
    public function setUnit($unit = null)
    {
        if (isset($unit)) {
            $this->unit = new Unit($unit->unitNumber, $unit->name, $unit->self);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUnitName() : ?string
    {
        if (isset($this->unit)) {
            return $this->unit->name;
        }

        return null;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setUnitName(string $name)
    {
        if (isset($this->unit)) {
            $this->unit->name = $name;
        } else {
            $this->unit = $this->economic->setClass('Unit', 'name');
            $this->unit->name = $name;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getUnitNumber() : ?int
    {
        if (isset($this->unit)) {
            return $this->unit->unitNumber;
        }

        return null;
    }

    /**
     * @param int $unitNumber
     * @return $this
     */
    public function setUnitNumber(int $unitNumber)
    {
        if (isset($this->unit)) {
            $this->unit->unitNumber = $unitNumber;
        } else {
            $this->unit = $this->economic->setClass('Unit', 'unitNumber');
            $this->unit->unitNumber = $unitNumber;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBarCode() : ?string
    {
        return $this->barCode;
    }

    /**
     * @param string $barCode
     * @return $this;
     */
    public function setBarCode(?string $barCode)
    {
        $this->barCode = $barCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBarred() : ?bool
    {
        return $this->barred;
    }

    /**
     * @param bool $barred
     * @return $this;
     */
    public function setBarred(bool $barred)
    {
        $this->barred = $barred;

        return $this;
    }

    /**
     * @return float
     */
    public function getCostPrice() : ?float
    {
        return $this->costPrice;
    }

    /**
     * @param float $costPrice
     * @return $this;
     */
    public function setCostPrice(?float $costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this;
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastUpdated() : ?string
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     * @return $this;
     */
    public function setLastUpdated(string $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

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
     * @return $this;
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductGroup
     */
    public function getProductGroup() : ?ProductGroup
    {
        return $this->productGroup;
    }

    /**
     * @param ProductGroup $productGroup
     * @return $this
     */
    public function setProductGroup($productGroup = null)
    {
        if (isset($productGroup)) {
            $this->productGroup = new ProductGroup($productGroup->productGroupNumber, $productGroup->name, $productGroup->products, $productGroup->salesAccounts, $productGroup->self);
        }

        return $this;
    }

    /** @return int */
    public function getProductGroupNumber() : ?int
    {
        if (isset($this->productGroup)) {
            return $this->productGroup->productGroupNumber;
        }

        return null;
    }

    /**
     * @param int $productGroupNumber
     * @return $this
     */
    public function setProductGroupNumber(int $productGroupNumber)
    {
        if (isset($this->productGroup)) {
            $this->productGroup->productGroupNumber = $productGroupNumber;
        } else {
            $this->productGroup = $this->economic->setClass('ProductGroup', 'productGroupNumber');
            $this->productGroup->productGroupNumber = $productGroupNumber;
        }

        return $this;
    }

    public function getProductGroupName() : ?string
    {
        if (isset($this->productGroup)) {
            return $this->productGroup->name;
        }

        return null;
    }

    public function setProductGroupName(string $name)
    {
        if (isset($this->productGroup)) {
            $this->productGroup->name = $name;
        } else {
            $this->productGroup = $this->economic->setClass('ProductGroup', 'name');
            $this->productGroup->name = $name;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getProductNumber() : ?string
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     * @return $this;
     */
    public function setProductNumber(string $productNumber)
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalesPrice() : ?float
    {
        return $this->salesPrice;
    }

    /**
     * @param float $salesPrice
     * @return $this;
     */
    public function setSalesPrice(float $salesPrice)
    {
        $this->salesPrice = $salesPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getRecommendedPrice() : ?float
    {
        return $this->recommendedPrice;
    }

    /**
     * @param float $recommendedPrice
     * @return $this;
     */
    public function setRecommendedPrice(float $recommendedPrice)
    {
        $this->recommendedPrice = $recommendedPrice;

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
     * @return $this
     */
    public function setSelf(?string $self)
    {
        $this->self = $self;

        return $this;
    }
}
