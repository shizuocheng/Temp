<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 21:30
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }

}