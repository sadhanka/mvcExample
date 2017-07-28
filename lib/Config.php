<?php

/**
 * Created by PhpStorm.
 * User: Lyubov Zhurba
 * Date: 21.07.2017
 * Time: 19:38
 */
class Config
{
    protected static $settings = array();

    static function get($key)
    {
        if (isset(self::$settings[$key]))
            return self::$settings[$key];
        else
            return null;
    }

    static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}