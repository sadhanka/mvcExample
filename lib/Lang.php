<?php


class Lang
{
    protected static $data;

    public static function load($langCode) {
        $langFilePath = ROOT . DS . 'lang' . DS . $langCode . '.php';

        if (file_exists($langFilePath)) {
            self::$data = include($langFilePath);
        }
        else {
            throw new Exception('Lang file "' . $langFilePath . '" was not found');
        }
    }

    public static function get($str, $defaultStr = '') {
        return isset(self::$data[$str]) ? self::$data[$str] : $defaultStr;
    }
}