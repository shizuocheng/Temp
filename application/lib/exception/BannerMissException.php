<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/10
 * Time: 16:29
 */

namespace app\lib\exception;


class BannerMissException extends  BaseException
{
    public $code=404;
    public  $msg='请求的banner不存在';
    public $errorCode=40000;

}