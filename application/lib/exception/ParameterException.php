<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/11
 * Time: 13:00
 */

namespace app\lib\exception;


use think\Exception;

class ParameterException extends BaseException
{
    public $code=400;
    public  $msg='参数错误';
    public $errorCode=10000;
}