<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 11-09-2017
 * Time: 16:24
 */
namespace Economic\Models;

class EconomicModel
{
    /**
     * @var \Economic $api
     */
    public $api;

    public function __construct($api)
    {
        $this->setApi($api);
    }

    /**
     * @return mixed
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param \Economic $api
     */
    public function setApi(&$api)
    {
        $this->api = $api;
        return $this;
    }

}