<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/13
 * Time: 21:19
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;

class Product extends BaseController
{
    public  function getOne($id){
        (new IDMustBePostiveInt())->goCheck();
        $product=ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }else{
            return $product;
        }


    }
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products=\app\api\model\Product::getMostRecent($count);
//        $collection=collection($products);这样可以让一个数组变成对象

        $products->hidden(['summary']);
        return $products;
        if($products->isEmpy()){

            throw new ProductException();
        }
        return $products;
    }


    public  function getAllInCategory($id=-1){
        (new IDMustBePostiveInt())->goCheck();
        $product=ProductModel::getProductsByCategoryTD($id,false);
//        return $product;
//        if($product->isEmpty()){
//            throw new ProductException();
//        }
        $product->hidden(['summary'])->toArray();
        return $product;

    }




}