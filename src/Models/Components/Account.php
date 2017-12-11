<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Account
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
