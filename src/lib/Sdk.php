<?php
namespace wapi\lib;
//date_default_timezone_set("Asia/Shanghai");

use wapi\lib\HttpClient;
/**
 * 挖数据 Sdk 类
 * 网址 https://www.wapi.cn
 * 作者:Safs
 * 时间：2022-01
*/
class Sdk{
    protected $config = [
        'appid'=>'',
        'secret'=>'',
        'debug'=>false
    ];
    public function __construct($config=false){
        if($config){
            $this->config = array_merge($this->config,$config);
        }
    }
    //
}
