<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 22-09-2017
 * Time: 12:41
 */

namespace Economic\Models\Components;


class ProductGroup
{

    public $productGroupNumber;

    public function __construct(int $productGroupNumber)
    {
        $this->productGroupNumber = $productGroupNumber;
    }

}

