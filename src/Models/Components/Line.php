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
    public $description;
    public $product;
    public $accrual;
    public $departmentalDistribution;
    public $discountPercentage;
    public $lineNumber;
    public $marginInBaseCurrency;
    public $marginPercentage;
    public $sortKey;
    public $unit;
    public $unitCostPrice;
    public $unitNetPrice;

    public function __construct($quantityNumber, $productNumber, $description, $costPrice)
    {
        $this->unitCostPrice = $costPrice;
        $this->description = $description;
        $this->quantity = $quantityNumber;

        $this->product = new Product($productNumber);
    }

    // Getters & Setters

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccrual()
    {
        return $this->accrual;
    }

    /**
     * @param mixed $accrual
     * @return $this
     */
    public function setAccrual($accrual)
    {
        $this->accrual = $accrual;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartmentalDistribution()
    {
        return $this->departmentalDistribution;
    }

    /**
     * @param mixed $departmentalDistribution
     * @return $this
     */
    public function setDepartmentalDistribution($departmentalDistribution)
    {
        $this->departmentalDistribution = $departmentalDistribution;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param mixed $discountPercentage
     * @return $this
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * @param mixed $lineNumber
     * @return $this
     */
    public function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarginInBaseCurrency()
    {
        return $this->marginInBaseCurrency;
    }

    /**
     * @param mixed $marginInBaseCurrency
     * @return $this
     */
    public function setMarginInBaseCurrency($marginInBaseCurrency)
    {
        $this->marginInBaseCurrency = $marginInBaseCurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarginPercentage()
    {
        return $this->marginPercentage;
    }

    /**
     * @param mixed $marginPercentage
     * @return $this
     */
    public function setMarginPercentage($marginPercentage)
    {
        $this->marginPercentage = $marginPercentage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortKey()
    {
        return $this->sortKey;
    }

    /**
     * @param mixed $sortKey
     * @return $this
     */
    public function setSortKey($sortKey)
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     * @return $this
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitCostPrice()
    {
        return $this->unitCostPrice;
    }

    /**
     * @param mixed $unitCostPrice
     * @return $this
     */
    public function setUnitCostPrice($unitCostPrice)
    {
        $this->unitCostPrice = $unitCostPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitNetPrice()
    {
        return $this->unitNetPrice;
    }

    /**
     * @param mixed $unitNetPrice
     * @return $this
     */
    public function setUnitNetPrice($unitNetPrice)
    {
        $this->unitNetPrice = $unitNetPrice;
        return $this;
    }

}