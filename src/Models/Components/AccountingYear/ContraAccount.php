<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44.
 */

namespace Economic\Models\Components\AccountingYear;

class ContraAccount
{
    /** @var int $accountNumber */
    public $accountNumber;
    /** @var string $accountType */
    public $accountType;
    /** @var string $self */
    public $self;

    public function __construct(int $accountNumber = null, string $accountType = null, string $self = null)
    {
        $this->accountType = $accountNumber;
        $this->accountType = $accountType;
        $this->self = $self;
    }
}
