<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/10
 * Time: 14:20
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{


    protected $rule=[
        'name'=>'require|max:10',//验证某个字段必须不为空
        'email'=>'email',
    ];

//$data=[
//'name'=>'validadschgasdcghdv',
//'email'=>'lxcqq.com'
//];
//$validate=new TestValidate();
//$result=$validate->batch()->check($data);
////       echo $validate->getError();
//var_dump($validate->getError());
//          $validate=new Test();
//        $result=$validate->check($data);//这个是单个的错误
//          $result=$validate->batch()->check($data);//这个是多个的错误  返回一个数组
//          var_dump($validate->getError());//输出多行错

}