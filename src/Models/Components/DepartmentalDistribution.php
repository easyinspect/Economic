<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class DepartmentalDistribution
{
    /** @var int $departmentalDistributionNumber */
    public $departmentalDistributionNumber;
    /** @var string $distributionType */
    public $distributionType;
    /** @var string $self */
    public $self;

    public function __construct(int $departmentalDistributionNumber = null, string $distributionType = null, string $self = null)
    {
        $this->departmentalDistributionNumber = $departmentalDistributionNumber;
        $this->distributionType = $distributionType;
        $this->self = $self;
    }

}