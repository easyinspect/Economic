<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 18-09-2017
 * Time: 13:51.
 */

namespace Economic\Models\Components;

class CustomerContact
{
    /** @var int $customerContactNumber */
    public $customerContactNumber;

    public function __construct(int $customerContact)
    {
        $this->customerContactNumber = $customerContact;
    }
}
