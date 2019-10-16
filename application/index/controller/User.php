<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 12:06
 */

namespace app\index\controller;


use app\index\model\UserLogModel;
use app\index\model\UserModel;
use app\index\validate\LoginValidate;
use app\index\validate\UserValidate;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use think\Controller;
use think\Db;

class User extends Controller
{
    /**
     * @method 用户注册
     * @return array|mixed
     */
    public function userRegister()
    {
        $data = input('post.');
        if(empty($data)) return $this->fetch();
        //数据校验
        if(!(new UserValidate())->goCheck()) throw new ParameterException();
        Db::startTrans();
        $model = new UserModel();
        $data['invitation_code'] = getInviteCode();//生成邀请码
        $result = $model->allowField(true)->insertGetId($data);

        //添加注册日志记录
        $userLogModel = new UserLogModel();
        $logRes = $userLogModel->addUserLog($result,$userLogModel::REGISTER);

        if($result && $logRes)
        {
            Db::commit();
            throw new SuccessMessage();
        }
        Db::rollback();
        throw new ParameterException(['msg'=>'注册失败']);
    }

    /**
     * @method 登录
     * @return mixed
     * @throws ParameterException
     * @throws SuccessMessage
     */
    public function userLogin()
    {
        $data = input('post.');

        if(empty($data)) return $this->fetch();

        if(!(new LoginValidate())->goCheck()) throw new ParameterException();

        //添加登录日志记录
        $userLogModel = new UserLogModel();
        $userInfo = (new UserModel())->getUserInfoByName($data['username']);
        $logRes = $userLogModel->addUserLog($userInfo['id'],$userLogModel::LOGIN);
        if(!$logRes) throw new ParameterException();

        session('userId',$userInfo['id']);
        throw new SuccessMessage();
    }

}