<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/28
 * Time: 14:15
 */

$incs = get_included_files();
$mainProjectPath = array_slice($incs,-2,1);

$GLOBALS['psr4loader'] = require __DIR__.'/../vendor/autoload.php';
$GLOBALS['psr4loader']->addPsr4('M\\',__DIR__);
$GLOBALS['psr4loader']->addPsr4(false,dirname($mainProjectPath[0]));
require __DIR__.'/boot.php';


