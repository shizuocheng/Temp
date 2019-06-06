<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/12
 * Time: 18:07
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];
    protected $message = [
        'code' => '没有code还想获取Token,做梦呢！'
    ];

}