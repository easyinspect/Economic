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

    public $customerContactnumber;

    public function __construct($customerContact)
    {
        $this->customerContactnumber = $customerContact;
    }

}