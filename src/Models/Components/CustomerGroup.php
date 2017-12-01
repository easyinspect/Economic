<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 13:24
 */

namespace Economic\Models\Components;


class CustomerGroup
{
    /** @var int $customerGroupNumber */
    public $customerGroupNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $customerGroupNumber = null, string $self = null)
    {
        $this->customerGroupNumber = $customerGroupNumber;
        $this->self = $self;
    }

}