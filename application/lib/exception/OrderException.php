<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/8
 * Time: 11:55
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}