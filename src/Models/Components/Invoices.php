<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12.
 */

namespace Economic\Models\Components;

class Invoices
{
    /** @var string $booked */
    public $booked;
    /** @var string $drafts */
    public $drafts;

    public function __construct(string $booked = null, string $drafts = null)
    {
        $this->booked = $booked;
        $this->drafts = $drafts;
    }
}
