<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 12:37
 */

namespace app\index\model;


use think\Model;

class BaseModel extends Model
{

    /**
     * @method 添加用户操作日志记录
     */
    public function addUserLog($uid,$event,$description='')
    {
        $data = [
            'uid'           =>  $uid,
            'event'         =>  $event,
            'client_ip'        =>  getClientIp(),
            'description'   =>  $description,
            'add_time'   =>  time(),
        ];
        return  $this->insert($data);
    }
}