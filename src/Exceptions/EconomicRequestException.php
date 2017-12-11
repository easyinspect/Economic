<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 17-10-2017
 * Time: 11:52.
 */

namespace Economic\Exceptions;

use Throwable;

class EconomicRequestException extends \Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        $this->message = \GuzzleHttp\json_decode($message);

        if (isset($this->message->errors) && is_array($this->message->errors)) {
            foreach ($this->message->errors as $error) {
                $message = $error;
            }
        } else {
            $message = $this->message->message;
        }

        parent::__construct($message, $code, $previous);
    }
}
