<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 04-12-2017
 * Time: 12:48.
 */

namespace Economic\Validations;

use Economic\Models\Unit;
use Economic\Exceptions\EconomicValidationException;

class UnitValidator
{
    public function validate(Unit $unit)
    {
        return ! is_null($unit->getName());
    }

    public function getException(Unit $unit)
    {
        $exception = new EconomicValidationException();

        if (is_null($unit->getName())) {
            $exception->addProperty('name');
        }

        return $exception;
    }

    public static function getValidator() : self
    {
        return new static();
    }
}
