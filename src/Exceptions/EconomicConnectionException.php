<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 08-11-2017
 * Time: 10:27.
 */

namespace Economic\Exceptions;

use Throwable;

class EconomicConnectionException extends \Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
