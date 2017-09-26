<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 15:16
 */

namespace Economic\Models\Components;


class VendorReference
{
    public $employeeNumber;

    public function __construct($employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }

}