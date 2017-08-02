<?php

/**
 * Created by PhpStorm.
 * User: Lyubov Zhurba
 * Date: 28.07.2017
 * Time: 20:42
 */
class Session
{
    protected static $userMessage;

    /**
     * @param mixed $userMessage
     */
    public static function setUserMessage($userMessage)
    {
        self::$userMessage = $userMessage;
    }

    public static function hasUmessage(){
        return isset(self::$userMessage) ? true : false;
    }

    public static function echoMessage() {
        echo self::$userMessage;
        self::$userMessage = null;
    }

    public static function setValue($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function getValue($key)
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : false);
    }

    public static function delValue($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
    }
}