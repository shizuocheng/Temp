<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/15
 * Time: 20:38
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\UserAddress;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\api\validate\AddressNew;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseController
{
//    protected  $beforeActionList=[
//        'first'=>['only'=>'second,third'],
//        //这个的意思是在执行后面两个second和third的时候会先执行first一次
//    ];
    protected  $beforeActionList=[
      'checkPrimaryScope'=>['only'=>'createOrUpdateAddress'],
    ];

    public function getUserAddress(){

        $uid = \app\api\service\Token::getCurrentUid();
        $userAddress = UserAddress::where('user_id', $uid)
            ->find();
        if(!$userAddress){
            throw new UserException([
                'msg' => '用户地址不存在',
                'errorCode' => 60001
            ]);
        }
        return $userAddress;
    }

//    public function checkPrimaryScope()
//    {
//        $scope = TokenService::getCurrentTokenVar('scope');
//        if ($scope) {
//
//
//            if ($scope >= ScopeEnum::User) {
//                return true;
//            } else {
//                throw new ForbiddenException();
//            }
//
//        }else{
//            throw new TokenException();
//        }
//    }


    public function createOrUpdateAddress()
    {
        //这儿有一个前置方法
        $validate = new AddressNew();
        $validate->goCheck();
        //根据token获取uid
        //根据uid查找用户数据 如果不存在，抛出异常
        //如果用户存在那么就获取从客户端传来的信息
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$uid) {
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->save($dataArray);
        } else {
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(),201);
    }

}