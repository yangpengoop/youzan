<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14
 * Time: 18:00
 */

namespace app\index\controller;


class Shop
{
    /**
     * 获取店铺名
     */
    public function getShopName()
    {
        require_once '../vendor/autoload.php';

        $accessToken = getAccessToken();
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.shop.get';
        $apiVersion = '3.0.0';

        //设置参数
        $params = [

        ];
        $response = $client->post($method, $apiVersion, $params);
        dump($response);
    }
}