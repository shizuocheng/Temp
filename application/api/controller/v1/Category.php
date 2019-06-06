<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/7
 * Time: 15:45
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;


class Category extends  BaseController
{
    public function getAllCategories(){
        $categories=CategoryModel::all([],'img');
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;

    }

}