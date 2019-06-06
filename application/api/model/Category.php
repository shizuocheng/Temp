<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/7
 * Time: 15:46
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden=['delete_time','update_time','create_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');


    }

}