<?php
namespace app\index\controller;

use app\index\validate\UserValidate;
use app\lib\exception\ParameterException;
use think\Db;

class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello()
    {
//        session('qwe',123);
        dump(session(''));die;
        $payUrl = "1232wefdsdfsd";
       echo  strlen($payUrl);
        dump(getInviteCode());die;
        (new UserValidate())->goCheck();
    }


    public function test()
    {
        dump(session(''));die;
    }

    public function testZhiFu()
    {
        require_once '../vendor/autoload.php';

        $accessToken = $this->getAccessToken();
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.trade.bill.good.url.get';
        $apiVersion = '3.0.1';
        $good= $this->getGoodNameId($accessToken,'3nlo7fqcr08y7');
        //设置参数
        $params = [
            'item_id'  =>  $good['item_id'],
            'num'       => 2,
//            'use_wxpay'       => 1,
            'sku_id'       => $good['sku_id'],
            'source'  =>  'cart',
            'use_wxpay'  =>  0,
            'kdt_id'  =>  43817103,
            'order_type'  =>  0
        ];

        $response = $client->post($method,  $apiVersion, $params);
        dump($response);
    }

    /**
     * 获取accessToken
     */
    public function getAccessToken()
    {
        require_once '../vendor/autoload.php';
        $clientId = "566dc8b69b401aa19a";
        $clientSecret = "934fabe6cae24bd1ba80243b33151473";
        // 获取AccessToken
        $type = 'silent';
        $keys['kdt_id'] = '43817103';

        $accessToken = (new \Youzan\Open\Token($clientId, $clientSecret))->getToken($type, $keys);
        if($accessToken['access_token']) return $accessToken['access_token'];
        return "token获取失败";
    }


    public function getGoodNameId($accessToken='',$alias='')
    {
        require_once '../vendor/autoload.php';

        $accessToken = $accessToken;
        $client = new \Youzan\Open\Client($accessToken);

        $method = 'youzan.item.get';
        $apiVersion = '3.0.0';

        //设置参数
        $params = [
            'alias'=>$alias
        ];

        $response = $client->post($method, $apiVersion, $params);

        return  $response['data']['item']['skus'][0] ;
    }

    /**
     * 获取单个订单信息
     */
    public function getYouZanOrderInfo()
    {
        require_once '../vendor/autoload.php';

        $accessToken = $this->getAccessToken();
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


    /**
     * 获取店铺信息
     */
    public function getShopName()
    {
        require_once '../vendor/autoload.php';

        $accessToken = $this->getAccessToken();
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
