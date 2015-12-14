<?php
/**
 * Created by PhpStorm.
 * User: ff
 * Date: 15/12/13
 * Time: 下午1:58
 */

namespace Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    public static $log = null;
    const LEVELS =
        [100 => 'DEBUG',
         200 => 'INFO',
         250 => 'NOTICE',
         300 => 'WARNING',
         400 => 'ERROR',
         500 => 'CRITICAL',
         550 => 'ALERT',
         600 => 'EMERGENCY'];

    public static function init()
    {
        if (static::$log === null) {
            static::$log = new Logger('simple');
            static::$log->pushHandler(new StreamHandler(BASE_PATH . '/logs/simple.log', Logger::DEBUG));
        }
    }

    public static function __callStatic($method, $params)
    {
        if (!in_array(strtoupper($method),static::LEVELS)) {
            throw new \InvalidArgumentException('log level not find pleas dfault levels level');
        }
        static::addLog($method,$params);
    }

    public static function addLog($method,$params)
    {
        static::init();
        $method = 'add'.ucfirst($method);
        $params = json_encode(array_shift($params));
        static::$log->$method($params);
    }
}