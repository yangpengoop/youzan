<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 14:00
 */

namespace app\lib\exception;


use think\Exception;

/**
 * Class BaseException
 * 自定义异常基类
 * @package app\api\lib\exception
 */
class BaseException extends Exception
{
    public $code = 400;
    public $msg =  '参数错误';
    public $errorCode = '40000';

    public $shouldToClient = true;




    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     */
    public function __construct($params=[])
    {
        if(!is_array($params)){
            return;
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
    }
}