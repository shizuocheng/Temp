<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/11
 * Time: 15:43
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];

}