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

        if (isset($this->message->errors)) {
            foreach ($this->message->errors as $error) {
                if (! isset($error->errors)) {
                    $message = $error;
                }

                if (isset($error->errors)) {
                    foreach ($error->errors as $errorMessage) {
                        $message = $errorMessage->errorMessage.' / '.$errorMessage->developerHint;
                    }
                }

                if (isset($error->entries)) {
                    foreach ($error->entries->items as $item) {
                        foreach ($item as $class) {
                            if (isset($class->errors)) {
                                foreach ($class->errors as $errors) {
                                    $message = $errors->errorMessage.' / '.$errors->developerHint;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $message = $this->message->message;
        }

        parent::__construct($message, $code, $previous);
    }
}
