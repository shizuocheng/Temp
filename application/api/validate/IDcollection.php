<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/6
 * Time: 21:10
 */

namespace app\api\validate;


class IDcollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];
    protected $message = [
        'ids' => 'ids必须是以逗号分隔开的多个正整数'

    ];

    //ids= id1
    protected function CheckIDs($value)
    {
        $value = explode(',', $value);
        if (empty($value)) {
            return false;
        }
        foreach ($value as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            }
        }
        return true;
    }

}