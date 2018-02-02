<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

class Supplier
{
    /** @var int $supplierNumber */
    public $supplierNumber;
    /** @var int $supplierInvoiceNumber */
    public $supplierInvoiceNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $supplierNumber = null, int $supplierInvoiceNumber = null, string $self = null)
    {
        $this->supplierNumber = $supplierNumber;
        $this->supplierInvoiceNumber = $supplierInvoiceNumber;
        $this->self = $self;
    }
}
