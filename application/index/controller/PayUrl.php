<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 19:51
 */

namespace app\index\controller;


use app\index\model\PayUrlModel;
use app\index\model\UserLogModel;
use app\index\validate\PayUrlValidate;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use think\Controller;
use think\Db;

class PayUrl extends Controller
{

    /**
     * @method 提交交易码
     * @return mixed
     * @throws \app\lib\exception\ParameterException
     */
    public function subPayCode()
    {
        $data = input('post.');
        $data['uid'] = session('userId');
        if( !$data['uid'] ) return $this->redirect('/User/userLogin');
        if(empty($data)) return $this->fetch();
        //数据校验
        if(!(new PayUrlValidate())->goCheck()) throw new ParameterException();
        Db::startTrans();
        $model = new PayUrlModel();
        $data['add_time'] = time();
        $result = $model->allowField(true)->insertGetId($data);

        //添加注册日志记录
        $userLogModel = new UserLogModel();
        $logRes = $userLogModel->addUserLog($data['uid'],$userLogModel::UPLOAD_PAY_CODE);//上传交易码

        if($result && $logRes)
        {
            Db::commit();
            throw new SuccessMessage();
        }
        Db::rollback();
        throw new ParameterException(['msg'=>'提交失败']);
    }
}