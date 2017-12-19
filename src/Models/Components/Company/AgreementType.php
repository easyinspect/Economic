<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-12-2017
 * Time: 11:06.
 */

namespace Economic\Models\Components\Company;

class AgreementType
{
    /** @var int $agreementTypeNumber */
    public $agreementTypeNumber;
    /** @var string $name */
    public $name;

    public function __construct(int $agreementTypeNumber, string $name)
    {
        $this->agreementTypeNumber = $agreementTypeNumber;
        $this->name = $name;
    }
}
