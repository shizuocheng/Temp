<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/12
 * Time: 18:28
 */
return [
    'app_id'=>'',
    'app_secret'=>'',
    'login_url'=>"https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s",
];



//abaae9c79494e4366b8e9bf06eb695fd