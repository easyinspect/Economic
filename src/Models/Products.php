<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 10:45
 */

namespace Economic\Models;

use Economic\Models\Components\ProductGroup;

class Products
{
    private $barCode;
    private $barred;
    private $costPrice;
    private $salesPrice;
    private $recommendedPrice;
    private $description;
    private $lastUpdated;
    private $name;
    private $productGroup;
    private $productNumber;

    private $api;

    public function __construct(RespondToSchema $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $products = $this->api->retrieve('/products');
        return $products;
    }

    public function get($id)
    {
        $product = $this->api->retrieve('/products/' . $id);
        $this->processObject($product);
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

        $this->api->create('/products', array_filter($data));

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

        $this->api->update('/products/'. $this->getProductNumber(), $data);

        return $this;
    }

    public function processObject($object)
    {
        foreach ($object as $key => $value)
        {
            if (method_exists($this, 'set'.ucfirst($key)))
            {
                $this->{'set' . ucfirst($key)}($value);
            }
        }
        return $this;
    }

    // Getters & Setters

    /**
     * @return string
     */
    public function getBarCode()
    {
        return $this->barCode;
    }

    /**
     * @param string $barCode
     * @return $this;
     */
    public function setBarCode($barCode)
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getBarred()
    {
        return $this->barred;
    }

    /**
     * @param boolean $barred
     * @return $this;
     */
    public function setBarred($barred)
    {
        $this->barred = $barred;
        return $this;
    }

    /**
     * @return float
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * @param float $costPrice
     * @return $this;
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this;
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param string $lastUpdated
     * @return $this;
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this;
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ProductGroup
     */
    public function getProductGroup() : ProductGroup
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

    public function getProductGroupNumber()
    {
        if (isset($this->productGroup)) {
            return $this->productGroup->productGroupNumber;
        }
        return null;
    }

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
    public function getProductNumber()
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     * @return $this;
     */
    public function setProductNumber($productNumber)
    {
        $this->productNumber = $productNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalesPrice()
    {
        return $this->salesPrice;
    }

    /**
     * @param float $salesPrice
     * @return $this;
     */
    public function setSalesPrice($salesPrice)
    {
        $this->salesPrice = $salesPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getRecommendedPrice()
    {
        return $this->recommendedPrice;
    }

    /**
     * @param float $recommendedPrice
     * @return $this;
     */
    public function setRecommendedPrice($recommendedPrice)
    {
        $this->recommendedPrice = $recommendedPrice;
        return $this;
    }

}