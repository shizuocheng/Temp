<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/7
 * Time: 18:48
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查商品ID';
    public $errorCode = 20000;

}