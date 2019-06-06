<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/12
 * Time: 18:22
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppId, $this->wxAppSecret, $this->code);
//        echo $this->wxLoginUrl;

    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);//如果不加true会默认变成一个对象，加上就会变成一个数组
//        $wxResult= json_encode($wxResult);
        if (empty($wxResult)) {
            throw  new Exception('获取openid时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);

            } else {

                return $this->grantToken($wxResult);
            }
        }


    }

    private function grantToken($wxResult)
    {
        //拿到openid
        //到数据库中去看，看下这个openid是不是已经存在
        //如果存在，则不处理否则，就新增一个数据
        //生成令牌，准备缓存数据，写入缓存
        //把令牌返回给客户端去
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if (!$user)
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
        {
            $uid = $this->newUser($openid);
        } else {
            $uid = $user->id;
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;


    }

    private function saveToCache($wxResult)
    {
        $key = self::generateToken();
        $value = json_encode($wxResult);
        $expire_in = config('setting.token_expire_in');
        $result = cache($key, $value, $expire_in);
        if (!$result) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }


    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        //scope=32代表管理圆
        $cachedValue['scope'] = ScopeEnum::User;//ScopeEnum::User;
        return $cachedValue;
    }

    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }


    private function processLoginError($wxResult)
    {
        throw  new  WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode'],
        ]);
    }

}