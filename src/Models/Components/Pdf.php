<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Pdf
{
    /** @var string $heading */
    public $download;

    public function __construct(string $download)
    {
        $this->download = $download;
    }

}