<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44.
 */

namespace Economic\Models\Components\ProductGroup;


class TotalFromAccount
{
    /** @var int $accountNumber */
    public $accountNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $accountNumber = null, string $self = null)
    {
        $this->accountNumber = $accountNumber;
        $this->self = $self;
    }
}
