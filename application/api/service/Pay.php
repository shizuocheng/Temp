<?php
/**
 * Created by PhpStorm.
 * User: 不二大叔
 * Date: 2019/2/8
 * Time: 14:55
 */

namespace app\api\service;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');


class Pay
{
    private $orderNo;
    private $orderID;
    function __construct($orderID)
    {
        if (!$orderID)
        {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;

    }

    public function pay()
    {
        $this->checkOrderValid();

        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if (!$status['pass'])
        {
            return $status;
        }
        return $this->makeWxPreOrder($status['orderPrice']);
        //        $this->checkProductStock();
    }
    // 构建微信支付订单信息

    /**
     * @param $totalPrice
     * @return array
     * @throws \app\lib\exception\TokenException
     */
    private function makeWxPreOrder($totalPrice)
    {
        $openid = Token::getCurrentTokenVar('openid');

        if (!$openid)
        {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody('零食商贩');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
        return $this->getPaySignature($wxOrderData);
    }

    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
//            throw new Exception('获取预支付订单失败');
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        OrderModel::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }
    public function receiveNotify()
    {
//        $xmlData = file_get_contents('php://input');
//        Log::error($xmlData);
        $notify = new WxNotify();
        $notify->handle();
//        $xmlData = file_get_contents('php://input');
//        $result = curl_post_raw('http:/zerg.cn/api/v1/pay/re_notify?XDEBUG_SESSION_START=13133',
//            $xmlData);
//        return $result;
//        Log::error($xmlData);
    }



    private function checkOrderValid()
    {
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if (!$order)
        {
            throw new OrderException();
        }
//        $currentUid = Token::getCurrentUid();

        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException(
                [
                    'msg' => '订单与用户不匹配',
                    'errorCode' => 10003
                ]);
        }
        if($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNo = $order->order_no;
        return true;
    }

}