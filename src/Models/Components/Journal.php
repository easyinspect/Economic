<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class Journal
{
    /** @var int $journalNumber */
    public $journalNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $journalNumber = null, string $self = null)
    {
        $this->journalNumber = $journalNumber;
        $this->self = $self;
    }
}
