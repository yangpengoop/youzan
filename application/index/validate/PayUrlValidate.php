<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 19:53
 */

namespace app\index\validate;


use app\index\model\PayUrlModel;

class PayUrlValidate extends BaseValidate
{
    protected $rule = [
        'pay_url'  =>  'require|checkPayUrl|checkReSubPayUrl',
        'order_no'  =>  'require|checkOrderNo|checkReSubOrderNo'
    ];

    protected $message = [
        'pay_url.checkPayUrl'    =>  "支付链接格式不正确",
        'order_no.checkPayUrl'   =>  "订单格式不正确",
        'pay_url.checkReSubPayUrl'   =>  "付款链接已存在",
        'order_no.checkReSubOrderNo'   =>  "订单号已存在",
    ];


    /**
     * @method 支付链接简单前缀校验
     * @param $payUrl
     * @return bool
     */
    public function checkPayUrl( $payUrl )
    {
        $needle = "https://mclient.alipay.com/cashier/mobilepay.htm?alipay_exterface_invoke_assign_target=";
        if(strlen($payUrl)<30 || !strstr($payUrl,$needle)) return false;


        return true;
    }

    /**
     * @method 不能提交重复码
     * @param $payUrl
     * @return bool
     */
    public function checkReSubPayUrl( $payUrl )
    {
        // 不能提交重复码
        if( PayUrlModel::get(['pay_url'=>$payUrl]) ) return false;
        return true;
    }

    /**
     * @method 订单校验
     * @param $orderNo
     * @return bool
     */
    public function checkOrderNo( $orderNo )
    {
        if(strlen($orderNo)!=24) return false;
        return true;
    }

    /**
     * @method 不能重复提交订单号
     * @param $orderNo
     * @return bool
     */
    public function checkReSubOrderNo( $orderNo )
    {
        // 不能提交订单号
        if( PayUrlModel::get(['order_no'=>$orderNo]) ) return false;
        return true;
    }
}