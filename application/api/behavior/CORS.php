<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/11
 * Time: 18:09
 */

namespace app\api\behavior;


class CORS
{
    public function appInit(&$params)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }

}