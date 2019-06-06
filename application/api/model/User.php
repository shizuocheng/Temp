<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/12
 * Time: 18:20
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = User::where('openid', '=', $openid)
            ->find();
        return $user;
    }


}