<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/11
 * Time: 20:57
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    public function prefixImgUrl($value,$data){
        $finalUrl=$value;
        if($data['from']==1){
            $finalUrl=config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }

}