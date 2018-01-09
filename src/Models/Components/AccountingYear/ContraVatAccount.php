<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 26-09-2017
 * Time: 11:44.
 */

namespace Economic\Models\Components\AccountingYear;

class ContraVatAccount
{
    /** @var string $vatCode */
    public $vatCode;
    /** @var string $self */
    public $self;

    public function __construct(string $vatCode = null, string $self = null)
    {
        $this->vatCode = $vatCode;
        $this->self = $self;
    }
}
