<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/16
 * Time: 9:54
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;

}