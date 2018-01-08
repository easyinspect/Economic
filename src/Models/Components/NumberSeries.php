<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 16:32.
 */

namespace Economic\Models\Components;

class NumberSeries
{
    /** @var int $numberSeriesNumber */
    public $numberSeriesNumber;
    /** @var string $self */
    public $self;

    public function __construct(int $numberSeriesNumber = null, string $self = null)
    {
        $this->numberSeriesNumber = $numberSeriesNumber;
        $this->self = $self;
    }
}
