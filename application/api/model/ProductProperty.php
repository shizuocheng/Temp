<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 21:31
 */

namespace app\api\model;


class ProductProperty extends  BaseModel
{
    protected $hidden=['product_id', 'delete_time', 'id'];
}