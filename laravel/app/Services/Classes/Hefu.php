<?php

namespace Services\Classes;

use Exception;

/**
 * 合服描述类
 * 
 */
class Hefu
{
    private $src_id;
    private $des_id;
    private $updated;

    /**
     * 合服信息对象构建
     *
     * @param string $msg
     */
    public function __construct(string $msg)
    {
        $data = explode(',',$msg);
        if(!$data)
            throw  new Exception("实例化错误：$msg");
        $this->src_id = $data[0];
        $this->des_id = $data[1];
        $this->updated = $data[2];
    }

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null ;
    }
}