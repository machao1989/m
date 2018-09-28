<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/9/3
 * Time: 16:07
 */

use M\http\Router;

/*Router::map('/auth/index')->middleware(\admin\middleware\common::class);*/
Router::group('/')->middleware(\admin\middleware\common::class);
Router::group('/auth')->middleware(\admin\middleware\auth::class);
