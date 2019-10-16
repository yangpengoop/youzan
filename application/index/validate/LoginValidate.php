<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 20:59
 */

namespace app\index\validate;


class LoginValidate extends BaseValidate
{
    protected $rule = [
        'username'  =>  'require',
        'password'  =>  'require',
    ];
}