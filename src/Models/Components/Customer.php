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
    /** @var string $self */
    public $self;

    public function __construct(int $customerNumber = null, string $self = null)
    {
        $this->customerNumber = $customerNumber;
        $this->self = $self;
    }

}