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
    private $api;

    public function __construct(RespondToSchema $api)
    {
        $this->api = $api;
    }

    public function all()
    {
        $layouts = $this->api->retrieve('/layouts');
        return $layouts;
    }

    public function get($id)
    {
        $layout = $this->api->retrieve('/layouts/' . $id);
        return $layout;
    }

}