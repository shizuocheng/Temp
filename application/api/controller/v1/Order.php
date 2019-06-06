<?php
/**
 * Created by PhpStorm.
 * User: 13229
 * Date: 2018/11/16
 * Time: 18:18
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;
use think\Request;

class Order extends BaseController
{
    //用户在选择商品后，向api提交包括它 所选商品的相关信息
    //api接收到信息后，需要检测相关商品的库存量
    //有库存的话，就把订单数据存入数据库中 下单成功了，返回客户端信息，告诉他可以进行支付了
    //调用我们的支付接口，进行支付
    //这边还需要进一步的检测数据库库存量
    //服务器这边就可以调用微信的支付接口进行支付
    //微信会返回给我们一个支付的结果（——异步操作）
    //成功的话需要进行库存量检测
    //进行相应的库存量扣除
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser'],
        'checkSuperScope' => ['only' => 'delivery,getSummary']
    ];

    public function placeOrder(){

//        (new OrderPlace())->goCheck();
//        $products = input('post.products');

        $products=Request::instance()->post('products/a');
        $uid=\app\api\service\Token::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }
    //这个是分页的函数

    public function getSummaryByUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid=\app\api\service\Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty())
        {
//            81c026ead02852c774a2eb42600ac70d
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
//        $collection = collection($pagingOrders->items());
//        $data = $collection->hidden(['snap_items', 'snap_address'])
//            ->toArray();
        $data = $pagingOrders->hidden(['snap_items', 'snap_address','prepay_id'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];

    }



    public function getDetail($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail)
        {
            throw new OrderException();
        }
        return $orderDetail
            ->hidden(['prepay_id']);
    }
//    public function get($page=1,$size=20){
//        return $page.'1111111111'.$size;
//    }


    public function get($page=1, $size=20){


        (new PagingParameter())->goCheck();

//        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if ($pagingOrders->isEmpty())
        {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];
    }


    public function delivery11($id){
        (new IDMustBePostiveInt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if($success){
            return new SuccessMessage();
        }
    }



}