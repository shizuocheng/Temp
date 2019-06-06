<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 20:52
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;

}