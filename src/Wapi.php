<?php
namespace wapi;


use wapi\lib\Sdk;

class Wapi extends Sdk
{
    public function __construct($config = false)
    {
        parent::__construct($config);
    }

    public function wapi_244(){
        print_r($this->config);

    }
}