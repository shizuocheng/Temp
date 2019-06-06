<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 21:23
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'category_id',
        'create_time', 'update_time'];

    public function getMainImgUrlAttr($value, $data)
    {
        //这个函数就可以返回完整的url
        return $this->prefixImgUrl($value, $data);
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getProductDetail($id)
    {
        $product = self::with([
            'imgs' => function ($query) {
                $query->with(['imgUrl'])->order('order', 'asc');
            }])->with(['properties'])->find($id);
        return $product;
    }
    public  static function getMostRecent($count){
        $products=self::limit($count)->order('create_time desc')
            ->select();
        return $products;

    }
    public static function getProductsByCategoryTD($categoryID,$paginate = true, $page = 1, $size = 30){
        $query=self::where('category_id','=',$categoryID);
        if (!$paginate) {
            return $query->select();
        } else {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                'page' => $page,
            ]);
        }
    }

}