<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/11
 * Time: 15:45
 */

namespace app\api\model;




class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }

}