<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/29
 * Time: 11:09
 */

define('APP_ROOT',dirname($incs[0],2));//项目根目录
define('PRO_ROOT',dirname(array_slice($incs,-2,1)[0]));//项目根目录
define('APP_SPACE',str_replace(DIRECTORY_SEPARATOR,'\\',str_replace(PRO_ROOT,'',APP_ROOT)));

\M\kernel\Config::init();
require __DIR__.'/function.php';
if (substr(PHP_SAPI, 0, 3) == 'cgi') {
    define('APP_SAPI','CGI');
    require __DIR__.'/http/function.php';
    M\http\Process::init($incs);
} else {
    define('APP_SAPI','CLI');
    require __DIR__.'/cli/function.php';
}