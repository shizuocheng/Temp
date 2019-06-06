<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/7
 * Time: 15:12
 */

namespace app\api\validate;


class Count extends  BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];
}