<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/6
 * Time: 20:54
 */

namespace app\api\controller\v1;


use app\api\validate\IDcollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;
use think\Exception;

class Theme
{
    public function getSimpleList($ids = '')
    {
        (new IDcollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        if (!$result) {
            throw  new  ThemeException();
        }
        return $result;
    }

    public function getComplexOne($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $theme=ThemeModel::getThemeWithProducts($id);
        if(!$theme){
            //throw new ThemeException();
        }
        return $theme;
    }


}