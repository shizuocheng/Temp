<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/16
 * Time: 10:06
 */

namespace app\lib\exception;


class SuccessMessage extends  BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;

}