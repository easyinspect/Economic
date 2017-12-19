<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class CreditCardCompany
{
    /** @var int $accountNumber */
    private $customerNumber;
    /** @var string $self */
    private $self;

    public function __construct(int $customerNumber = null, string $self = null)
    {
        $this->customerNumber = $customerNumber;
        $this->self = $self;
    }
}
