<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components\AccountingYear;

use Economic\Models\Components\Account;

class Accruals
{
    /** @var Account $account */
    public $account;
    /** @var string $endDate */
    public $endDate;
    /** @var string $startDate */
    public $startDate;
    /** @var string $self */
    public $self;

    public function __construct(\stdClass $stdClass = null, string $endDate = null, string $startDate = null, string $self = null)
    {
        $this->account = new Account($stdClass->accountNumber, $stdClass->self);
        $this->endDate = $endDate;
        $this->startDate = $startDate;
        $this->self = $self;
    }
}
