<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 13-09-2017
 * Time: 14:05
 */

namespace Economic\Models;

interface RespondToSchema
{
    public function retrieve($url);
    public function create($url, $body);
    public function update($url, $body);
    public function delete($url);

}