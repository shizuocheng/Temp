<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/11
 * Time: 19:40
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    protected $hidden=['from','id','delete_time','update_time'];

    protected function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }


}