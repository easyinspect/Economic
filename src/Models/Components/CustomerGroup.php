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

    public $customerGroupNumber;

    public function __construct(int $customerGroupNumber)
    {
        $this->customerGroupNumber = $customerGroupNumber;
    }

}