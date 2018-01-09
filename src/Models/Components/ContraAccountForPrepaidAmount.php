<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class ContraAccountForPrepaidAmount
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
