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
        $this->salesPerson = new SalesPerson(isset($salesPerson) ? $salesPerson->employeeNumber : null, isset($salesPerson) ? $salesPerson->self : null);
        $this->vendorReference = new VendorReference(isset($vendorReference) ? $vendorReference->employeeNumber : null, isset($vendorReference) ? $vendorReference->self : null);
    }
}