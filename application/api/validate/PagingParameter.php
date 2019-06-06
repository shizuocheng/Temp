<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/8
 * Time: 21:14
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];

}