<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44.
 */

namespace Economic\Models\Components;

class Attention
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
