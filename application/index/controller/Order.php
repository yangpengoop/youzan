<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14
 * Time: 18:02
 */

namespace app\index\controller;


class Order
{

    public function getOrderInfo()
    {
        require_once '../vendor/autoload.php';

        $accessToken = getAccessToken();
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.trade.get';
        $apiVersion = '4.0.0';

        //设置参数
        $params = [
//            'goods_id'  =>  502622688,
//            'status'  =>  'WAIT_SELLER_SEND_GOODS',
            'tid'   =>  'E20191013122324043900001'
        ];

        $response = $client->post($method, $apiVersion, $params);

        dump($response);
    }
}