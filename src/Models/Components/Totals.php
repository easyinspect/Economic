<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Totals
{
    /** @var string $booked */
    public $booked;
    /** @var string $drafts */
    public $drafts;
    /** @var string $self */
    public $self;

    public function __construct(string $booked = null, string $drafts = null, string $self = null)
    {
        $this->booked = $booked;
        $this->drafts = $drafts;
        $this->self = $self;
    }

}