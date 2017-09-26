<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 25-09-2017
 * Time: 17:10
 */

namespace Economic\Models;


class Layouts
{
    private $listener;

    public function __construct(RespondToSchema $listener)
    {
        $this->listener = $listener;
    }

    public function all()
    {
        $layouts = $this->listener->retrieve('/layouts');
        return $layouts;
    }

    public function get($id)
    {
        $layout = $this->listener->retrieve('/layouts/' . $id);
        return $layout;
    }

}