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

    public function __construct(string $bankAccountNumber, string $bankGiroNumber, string $bankName, string $bankSortCode, string $pbsCustomerGroupNumber, string $pbsFiSupplierNumber)
    {
        $this->bankAccountNumber = $bankAccountNumber;
        $this->bankGiroNumber = $bankGiroNumber;
        $this->bankName = $bankName;
        $this->bankSortCode = $bankSortCode;
        $this->pbsCustomerGroupNumber = $pbsCustomerGroupNumber;
        $this->pbsFiSupplierNumber = $pbsFiSupplierNumber;
    }
}
