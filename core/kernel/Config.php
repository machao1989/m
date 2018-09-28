<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/29
 * Time: 11:06
 */

namespace M\kernel;


class Config {
    public static $items;

    public static function init(){
        self::$items = require __DIR__.'/defaultConfig.php';
    }

    public static function get($name){
        return self::$items[$name]??null;
    }
}