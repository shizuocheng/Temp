<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/10/16
 * Time: 20:18
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected  $rule=[
        'id'=>'require|isPositiveInteger'
    ];
    protected $message = [
        'id' => 'id must be positiveInt'
    ];

}