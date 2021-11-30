<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Webmozart\PathUtil\Path;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;

if (!function_exists('loadMonoLogger')) {
    /**
     * 加载扩展日志库
     * @param string $name
     * @return Logger
     */
    function loadMonoLogger($name, $level = Logger::INFO)
    {
        $logger  = new Logger($name);
        $handler = new StreamHandler(storage_path("logs/{$name}.log"), $level);
        $logger->pushHandler($handler);
        return $logger;
    }
}

if (!function_exists('getMillisecond')){
    // 毫秒级时间戳
    function getMillisecond(){
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}

if (!function_exists('stringToBoolean')) {
    /**
     * 字符串转逻辑值
     * @param string $src
     * @return Boolean
     */
    function stringToBoolean($src) {
        switch (trim(strtolower($src))) {
            case "true": case "yes": case "1": case "on": return true;
            case "false": case "no": case "0": case "off": case "": case null: return false;
            default: return !!$src;
        }
    }
}

if (! function_exists('user')){
    /**
     * 获取已登陆用户信息
     * @param string $parameter
     * @return \App\User|mixed
     */
    function user($parameter = null){
        if (!\Auth::check()) {
            return null;
        }
        if ($parameter) {
            return \Auth::user()->$parameter;
        }
        return \Auth::user();
    }
}



if (! function_exists('toAmount')){
    /**
     * 金额转换为浮点值
     * @param Brick\Money\Money $money
     * @return float
     */
    function toAmount($money){
        return $money->getAmount()->toFloat();
    }
}

if (! function_exists('loadLibrary')) {
    /**
     * Loads and instantiates helpers.
     * Designed to be called from application controllers.
     *
     * @param   string  $library Library name
     * @param   string  $class_name An optional object name to assign to
     * @param   array   $params Optional parameters to pass to the library class constructor
     * @return  object|array
     */
    function loadLibrary($library, $class_name = null, $params = []){
        $name = Path::getFilename($library);
        $path = Path::join(__DIR__, "Libraries", $name . ".php");
        if (!file_exists($path)) {
            throw new FileNotFoundException("{$path} file not found!");
        }
        include_once($path);
        if (is_string($class_name)) {
            return isset($params)
            ? new $class_name(...$params)
            : new $class_name();
        }
    }
}


if(! function_exists('duplicateException')) {
    /**
     * 数据库唯一索引异常
     * @param \Exception $e
     * @return void|boolean
     */
    function duplicateException($e)
    {
        if($e instanceof QueryException){
            $errorCode = $e->errorInfo[1];
            return $errorCode == 1062;
        }
    }
}

if(! function_exists('safeIncrement')) {
    /**
     * 安全增加模型列值
     * @param Model $instance 
     * @param string $column 
     * @param int $amount 
     * @return mixed 
     */
    function safeIncrement($instance, $column, $amount = 1)
    {
        if ($instance instanceof Model)
            return $instance->increment($column, $amount);
    }
}

if(! function_exists('safeDecrement')) {
    /**
     * 安全减少模型列值
     * @param Model $instance 
     * @param string $column 
     * @param int $amount 
     * @return mixed 
     */
    function safeDecrement($instance, $column, $amount = 1)
    {
        if ($instance instanceof Model)
            return $instance->decrement($column, $amount);
    }
}



