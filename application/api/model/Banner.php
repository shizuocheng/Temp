<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/10
 * Time: 15:53
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends BaseModel
{
    protected $hidden=['delete_time','update_time'];
//这个不是一个普通的函数，是一个关联模型
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])->find($id);
//        $data=$banner->toArray();
//        unset($data['delete_time']);
        $banner->hidden(['delete_time','']);//
//        $banner->visible(['id']);//只显示里面的代码


//        根据banner id号获取bannner信息
//        $result= Db::query('select * from banner_item where banner_id=?',[$id]);
//        return $result;
//        $reslut = Db::table('banner_item')->where('banner_id', '=', $id)->select();//find只返回一个数据，
//        ORM object Relation Mapping 对象关系映射
        return $banner;
    }
}