<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 21:39
 */

namespace app\lib\exception;


class ProductException extends BaseException
{

    public $code = 404;
    public $msg = '指定商品不存在，请检查商品ID';
    public $errorCode = 20000;
}