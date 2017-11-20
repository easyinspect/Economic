<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 10:45
 */

namespace Economic\Models;

use Economic\Economic;
use Economic\Models\Components\ProductGroup;

class Products
{
    /** @var string $barCode*/
    private $barCode;
    /** @var boolean $barred*/
    private $barred;
    /** @var float $costPrice*/
    private $costPrice;
    /** @var float $salesPrice*/
    private $salesPrice;
    /** @var float $recommendedPrice*/
    private $recommendedPrice;
    /** @var string $description*/
    private $description;
    /** @var string $lastUpdated*/
    private $lastUpdated;
    /** @var string $name*/
    private $name;
    /** @var ProductGroup $productGroup*/
    private $productGroup;
    /** @var int $productNumber*/
    private $productNumber;

    /** @var Economic $api*/
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all($pagesize = 1000)
    {
        $products = $this->api->retrieve('/products?pagesize='. $pagesize);
        return $products;
    }

    public function get($id)
    {
        $product = $this->api->retrieve('/products/' . $id);
        $this->api->setObject($product, $this);
        return $this;
    }

    public function delete()
    {
        $this->api->delete('/products/' . $this->getProductNumber());
        return $this;
    }

    public function create()
    {
        $data = [
            'barCode' => $this->getBarCode(),
            'barred' => $this->getBarred(),
            'costPrice' => $this->getCostPrice(),
            'salesPrice' => $this->getSalesPrice(),
            'recommendedPrice' => $this->getRecommendedPrice(),
            'description' => $this->getDescription(),
            'lastUpdated' => $this->getLastUpdated(),
            'name' => $this->getName(),
            'productGroup' => $this->getProductGroup(),
            'productNumber' => $this->getProductNumber()
        ];

        $product = $this->api->create('/products', array_filter($data));
        $this->api->setObject($product, $this);
        return $this;

    }

    public function update()
    {
        $data = [
            'barCode' => $this->getBarCode(),
            'barred' => $this->getBarred(),
            'costPrice' => $this->getCostPrice(),
            'salesPrice' => $this->getSalesPrice(),
            'recommendedPrice' => $this->getRecommendedPrice(),
            'description' => $this->getDescription(),
            'lastUpdated' => $this->getLastUpdated(),
            'name' => $this->getName(),
            'productGroup' => $this->getProductGroup(),
            'productNumber' => $this->getProductNumber()
        ];

        $product = $this->api->update('/products/'. $this->getProductNumber(), $data);
        $this->api->setObject($product, $this);
        return $this;
    }

    // Getters & Setters

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
    public function setBarCode(string $barCode)
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getBarred() : ?boolean
    {
        return $this->barred;
    }

    /**
     * @param boolean $barred
     * @return $this;
     */
    public function setBarred(boolean $barred)
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
    public function setCostPrice(float $costPrice)
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
    public function setDescription(string $description)
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
    public function setProductGroup($productGroup)
    {
        $this->productGroup = new ProductGroup($productGroup->productGroupNumber);
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
     * @return $this */

    public function setProductGroupNumber(int $productGroupNumber)
    {
        if (isset($this->productGroup)) {
            $this->productGroup->productGroupNumber = $productGroupNumber;
        } else {
            $this->productGroup = new ProductGroup($productGroupNumber);
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

}