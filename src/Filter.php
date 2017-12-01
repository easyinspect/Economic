<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 06-10-2017
 * Time: 11:28
 */

namespace Economic;


class Filter
{
    /** @var array $filterable */
    private $filterable;
    /** @var array $operator */
    private $operator;
    /** @var array $value */
    private $value;
    /** @var string $string */
    private $string = null;

    public function __construct($filterable = [], $operator = [], $value = [])
    {
        $this->filterable = $filterable;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function filter()
    {
        foreach ($this->filterable as $key => $value) {
            if (is_null($this->string)) {
                $this->string = 'filter=' . $this->filterable[$key] . $this->operator[$key] . $this->value[$key];
            } else {
                $this->string .= '$and:' . $this->filterable[$key] . $this->operator[$key] . $this->value[$key];
            }
        }

       return $this->string;
    }
}