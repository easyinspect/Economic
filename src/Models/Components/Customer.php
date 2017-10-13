<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:29
 */

namespace Economic\Models\Components;


class Customer
{
    /** @var  int $customerNumber */
    public $customerNumber;

    public function __construct(int $customerNumber)
    {
        $this->customerNumber = $customerNumber;
    }

}