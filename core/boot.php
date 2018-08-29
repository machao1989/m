<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/29
 * Time: 11:09
 */

if (substr(PHP_SAPI, 0, 3) == 'cgi') {
    define('APP_SAPI','CGI');
    http\HttpProcess::init($incs);
} else {
    define('APP_SAPI','CLI');
}