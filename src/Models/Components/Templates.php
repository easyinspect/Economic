<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Templates
{
    /** @var string $invoice */
    public $invoice;
    /** @var string $invoiceLine */
    public $invoiceLine;
    /** @var string $heading */
    public $self;

    public function __construct(string $invoice = null, string $invoiceLine = null, string $self = null)
    {
        $this->invoice = $invoice;
        $this->invoiceLine = $invoiceLine;
        $this->self = $self;
    }

}