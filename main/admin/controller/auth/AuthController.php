<?php
/**
 * Created by PhpStorm.
 * User: machao
 * Date: 2018/8/29
 * Time: 11:45
 */

namespace admin\controller\auth;

use M\http\baseController;

class AuthController extends baseController
{
    public function get(){
        POST('key','default');



        return 'hahahah ';
    }
}