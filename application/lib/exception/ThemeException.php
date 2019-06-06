<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/6
 * Time: 22:11
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;


}