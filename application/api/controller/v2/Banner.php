<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/11
 * Time: 21:14
 */

namespace app\api\controller\v2;


class Banner
{
    public function getBanner($id)
    {

        return 'this is a v2 version';//不能直接返回数组；要先json返回一下,
    }


}