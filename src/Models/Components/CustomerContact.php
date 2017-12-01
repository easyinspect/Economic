<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 13:51
 */

namespace Economic\Models\Components;


class CustomerContact
{
    /** @var int $customerContactNumber */
    public $customerContactNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $customerContactNumber = null, string $self = null)
    {
        $this->customerContactNumber = $customerContactNumber;
        $this->self = $self;
    }

}