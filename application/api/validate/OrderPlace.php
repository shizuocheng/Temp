<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/16
 * Time: 19:28
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    protected $rule = [
        'products' => 'checkProducts'
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger',
    ];


    public function checkProducts($values){

        if(empty($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        if(!is_array($values)){
            throw new ParameterException([
                'msg' => '参数错误11111111111'
            ]);
        }
        foreach ($values as $value)
        {
            $this->checkProduct($value);
        }
        return true;
    }


    private function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if (!$result) {
            throw new ParameterException([
                'msg' => '商品列表参数错误',
            ]);
        }
    }


}