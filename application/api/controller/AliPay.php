<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 16:50
 */

namespace app\api\controller;


class AliPay
{
    private $config = array(
        'app_id'=>'你的appid',
        'notify_url'=>"http://xxx/api/Alipay/aliNotifyUrl", //支付回调地址
        'return_url'=>'http://yansongda.cn/return.php',
        'ali_public_key'=>'支付宝公钥',
        'private_key'=>'你的私钥'
    );

    public function pay($body, $orderid, $out_trade_no, $total_fee, $type){
        //引入sdk
        vendor('aop.AopClient');
        vendor('aop.request.AlipayTradeAppPayRequest');
        $aop                     = new \AopClient();
        $aop->gatewayUrl         = "https://openapi.alipay.com/gateway.do";
        $aop->appId              = $this->config['app_id'];
        $aop->rsaPrivateKey      = $this->config['private_key']; //私钥
        $aop->format             = "json";
        $aop->charset            = "UTF-8";
        $aop->signType           = "RSA2";
        $aop->alipayrsaPublicKey = $this->config['ali_public_key']; //公钥
        $request                 = new \AlipayTradeAppPayRequest();
        $bizcontent = json_encode([
            'body'=>$body,
            'subject'=>$body,
            'out_trade_no'=> $out_trade_no,
            'total_amount'=> $total_fee,
            'timeout_express'=>'30m',
            'product_code'=>'QUICK_MSECURITY_PAY'
        ]);

        $request->setNotifyUrl($this->config['notify_url']);
        $request->setBizContent($bizcontent);
        $response = $aop->sdkExecute($request);
        if($response){
            echo json_encode(['status'=>1,'msg'=>'success','orderid'=>$orderid,'data'=>$response]);
        }else{
            echo json_encode(['status'=>0,'msg'=>'false','orderid'=>$orderid]);
        }
    }

    //支付回调
    public function aliNotifyUrl(){
        //接收参数
        $params = input();
        //开启事务
        Db::startTrans();
        try{
            #你的回调处理业务逻辑代码
    	}catch(\Exception $e){
            Db::rollback();
        }
        echo "success";
    }

    // 保存支付宝订单流水号
    public function saveAliFlowSno(){
        $out_trade_no = input('out_trade_no');
        $trade_no = input('trade_no');
        $order = Db::name('order')->where(['order_sn'=>$out_trade_no])->find();
        $data['id'] = $order['id'];
        $data['flow_sn'] = $trade_no;
        Db::name('order')->update($data);
    }



}