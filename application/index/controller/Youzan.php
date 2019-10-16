<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14
 * Time: 16:12
 */

namespace app\index\controller;


class Youzan
{
    public function getYouZanOrderInfo()
    {
        require_once './vendor/autoload.php';

        $accessToken = 'fill your token';
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.trades.sold.get';
        $apiVersion = '4.0.0';

        //设置参数
        $params = [

        ];

        $response = $client->post($method, $apiVersion, $params);
        dump($response);
    }
}