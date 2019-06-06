<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/12
 * Time: 20:20
 */

namespace app\lib\exception;


class WeChatException extends  BaseException
{
    public $code=400;
    public $msg='微信接口调用失败';
    public $errorCode=999;

}