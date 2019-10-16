<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 12:37
 */

namespace app\index\model;


class UserModel extends BaseModel
{
    protected $table = "youzan_user";

    public function getUserInfoByName($username)
    {
        return $this->where(['username'=>$username])->find();
    }
}