<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 28-09-2017
 * Time: 10:12
 */

namespace Economic\Models\Components;


class Notes
{
    /** @var string $heading */
    public $heading;
    /** @var string $textLine1 */
    public $textLine1;
    /** @var string $textLine2 */
    public $textLine2;

    public function __construct(string $heading = null, string $textLine1 = null, string $textLine2 = null)
    {
        $this->heading = $heading;
        $this->textLine1 = $textLine1;
        $this->textLine2 = $textLine2;
    }

}