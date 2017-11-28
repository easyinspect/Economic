<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 12:58
 */

namespace Economic\Models\Components;

class References
{
    /** @var SalesPerson $name */
    public $salesPerson;
    /** @var VendorReference $vendorReference */
    public $vendorReference;

    public function __construct($vendorReference = null, $salesPerson = null)
    {
        $this->salesPerson = new SalesPerson($salesPerson->employeeNumber, $salesPerson->self);
        $this->vendorReference = new VendorReference($vendorReference->employeeNumber, $vendorReference->self);
    }


}