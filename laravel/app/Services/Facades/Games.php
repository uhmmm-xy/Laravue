<?php
namespace Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see Services\Classes\Games
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
