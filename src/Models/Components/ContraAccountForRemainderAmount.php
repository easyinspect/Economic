<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class ContraAccountForRemainderAmount
{
    /** @var int $accountNumber */
    private $accountNumber;
    /** @var string $self */
    private $self;

    public function __construct(int $accountNumber = null, string $self = null)
    {
        $this->accountNumber = $accountNumber;
        $this->self = $self;
    }
}
