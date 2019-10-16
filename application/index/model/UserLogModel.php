<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 16:59
 */

namespace app\index\model;


class UserLogModel extends BaseModel
{
    protected $table = "youzan_user_log";

    const UPLOAD_PAY_CODE   = 1;//提交支付码
    const LOGIN             = 2;//登录
    const REGISTER          = 3;//注册
}