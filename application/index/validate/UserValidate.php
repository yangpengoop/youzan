<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 12:09
 */

namespace app\index\validate;


use app\index\model\UserModel;

class UserValidate extends BaseValidate
{
    protected $rule = [
        'username'          =>  'require',
        'phone'             =>  'require|phoneUnique',
        'invited_code'      =>  'require|inviteCodeCheck',
        'email'             =>  'require',
        'password'             =>  'require',
    ];

    protected $message =[
        'phone.phoneUnique' =>  '一个手机号只能注册一次'
    ];

    /**
     * 一个手机号只能注册一次
     */
    public function phoneUnique($phone)
    {
        $where = [
            'phone' =>  $phone,
            'status' =>  1,//正常用户状态
        ];
        $userInfo = (new UserModel())->where($where)->find();
        if($userInfo) return false;
        return true;
    }

    /**
     * @mehod 受邀码校验
     */
    public function inviteCodeCheck($code)
    {
        $userInfo = (new UserModel())->where(['invitation_code'=>$code])->find();
        if(!$userInfo || $userInfo['status']!=1) return false;
        return true;
    }
}