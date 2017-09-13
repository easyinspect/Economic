<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 14:05
 */

namespace Economic;


interface RespondToSchema
{
    public function retrieve($url);
    public function create();
    public function update();
    public function delete();

}