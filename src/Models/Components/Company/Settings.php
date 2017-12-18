<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class Settings
{
    /** @var string $baseCurrency */
    public $baseCurrency;
    /** @var string $internationalLedger */
    public $internationalLedger;

    public function __construct(string $baseCurrency, string $internationalLedger = null)
    {
        $this->baseCurrency = $baseCurrency;
        $this->internationalLedger = $internationalLedger;
    }
}
