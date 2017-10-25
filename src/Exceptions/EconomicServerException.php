<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 11:53
 */

namespace Economic\Exceptions;

use Throwable;

class EconomicServerException extends \Exception
{
     public function __construct($message = "", $code = 0, Throwable $previous = null)
     {
         parent::__construct($message, $code, $previous);
     }
}