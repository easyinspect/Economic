<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class BankInformation
{

    /** @var string $bankAccountNumber */
    public $bankAccountNumber;
    /** @var string $bankGiroNumber */
    public $bankGiroNumber;
    /** @var string $bankName */
    public $bankName;
    /** @var string $bankSortCode */
    public $bankSortCode;
    /** @var string $pbsCustomerGroupNumber */
    public $pbsCustomerGroupNumber;
    /** @var string $pbsFiSupplierNumber */
    public $pbsFiSupplierNumber;

    public function __construct(string $bankAccountNumber = null, string $bankGiroNumber = null, string $bankName = null, string $bankSortCode = null, string $pbsCustomerGroupNumber = null, string $pbsFiSupplierNumber = null)
    {
        $this->bankAccountNumber = $bankAccountNumber;
        $this->bankGiroNumber = $bankGiroNumber;
        $this->bankName = $bankName;
        $this->bankSortCode = $bankSortCode;
        $this->pbsCustomerGroupNumber = $pbsCustomerGroupNumber;
        $this->pbsFiSupplierNumber = $pbsFiSupplierNumber;
    }
}
