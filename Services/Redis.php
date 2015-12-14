<?php
namespace Services;


use Predis\Client;

class Redis
{
    const CONFIG_FILE = '/config/redis.php';
    protected static $redis = null;

    public static function init()
    {
        if(static::$redis === null)
        static::$redis = new Client(require BASE_PATH.static::CONFIG_FILE);
    }

    public static function set($key, $value, $time = null, $unit = null)
    {
        static::init();
        if($time){
            switch ($unit){
                case 'h':
                    $time *= 3600;
                    break;
                case 'm':
                    $time *= 60;
                    break;
                case 's':
                case 'ms':
                    break;
                default:
                    throw new \InvalidArgumentException('单位只能是 h m s ms');
                    break;
            }
            if($unit=='ms'){
                self::_psetex($key,$value,$time);

            } else {

                self::_setex($key,$value,$time);

            }

        } else {

            self::$redis->set($key,$value);

        }
    }

    public static function get($key)
    {
        static::init();
        return static::$redis->get($key);
    }

    public static function delete($key)
    {
        static::init();
        return static::$redis->del($key);
    }

    public static function _setex($key,$value,$time)
    {
        static::$redis->setex($key,$time,$value);
    }

    public static function _psetex($key,$value,$time)
    {
        static::$redis->psetex($key,$time,$value);
    }


}