<?php
/**
 * 全局辅助函数
 * 这些函数旨在全局快捷调用
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/9/3
 * Time: 15:37
 */

/**
 * 获取项目配置
 * @param $name
 */
function config($name){
    return \M\kernel\Config::get($name);
}