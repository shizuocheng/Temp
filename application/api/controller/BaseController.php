<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/16
 * Time: 19:15
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token;

class BaseController extends Controller
{
    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

//    protected function checkSuperScope()
//    {
//        Token::needSuperScope();
//    }

}