<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/10/15
 * Time: 23:02
 */

namespace app\api\controller\v1;

/**
 * Class Banner
 * @package app\api\controller\v1
 * @url /banner/:id
 * @http GET请求
 * @id bannner的id号；
 */
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\Test;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{
//
    /**
     *id指的是获取的哪个Bammer，这样如果以后代码有变化的话，就不用改了；
     *
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $banner = BannerModel::getBannerById($id);

        if (!$banner) {
            throw new BannerMissException();
        }
//        $c = config('setting.img_prefix');
        return $banner;//不能直接返回数组；要先json返回一下,
    }



}