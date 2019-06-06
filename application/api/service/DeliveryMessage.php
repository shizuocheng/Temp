<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/11
 * Time: 17:13
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\exception\UserException;

class DeliveryMessage extends WxMessage
{
    const DELIVERY_MSG_ID = 'daFL0IihGhAArtlFQZn4BDZJlqV_H3pW7zBx7J1ECH4';// 小程序模板消息ID号

    //    private $productName;
    //    private $devliveryTime;
    //    private $order
//下面的第二个参数可以把小程序的跳转路径以字符串的形式传到，然后进行跳转

    public function sendDeliveryMessage($order, $tplJumpPage = '')
    {
        if (!$order) {
            throw new OrderException();
        }
        $this->tplID = self::DELIVERY_MSG_ID;
        $this->formID = $order->prepay_id;
        $this->page = $tplJumpPage;
        $this->prepareMessageData($order);
        $this->emphasisKeyWord='keyword2.DATA';
        return parent::sendMessage($this->getUserOpenID($order->user_id));
    }



    private function prepareMessageData($order)
    {
        $dt = new \DateTime();
        $data = [
            'keyword1' => [
                'value' => '辰辰速运',
            ],
            'keyword2' => [
                'value' => $order->snap_name,
                'color' => '#27408B'
            ],

            'keyword3' => [
                'value' => $order->order_no
            ],
            'keyword4' => [
                'value' => $dt->format("Y-m-d H:i")
            ]
        ];
        $this->data = $data;
    }

    private function getUserOpenID($uid)
    {
        $user = User::get($uid);
        if (!$user) {
            throw new UserException();
        }
        return $user->openid;
    }

}