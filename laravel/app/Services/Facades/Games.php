<?php
namespace Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Services\Classes\Games
 * @method static array getLunhuiMap() 获取所有地图
 * @method static array getAllNode() 获取所有节点
 */
class Games extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(){
        return "games";
    }    
}
