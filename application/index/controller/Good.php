<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14
 * Time: 18:01
 */

namespace app\index\controller;


class Good
{
    public function getAllGoods()
    {
        require_once '../vendor/autoload.php';

        $accessToken = getAccessToken();
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.items.onsale.get';
        $apiVersion = '3.0.0';

        //设置参数
        $params = [
//            'goods_id'  =>  502622688,
//            'status'  =>  'WAIT_SELLER_SEND_GOODS',
//            'tid'   =>  'E20191013122324043900001'
        ];

        $response = $client->post($method, $apiVersion, $params);

        dump($response);
    }
}