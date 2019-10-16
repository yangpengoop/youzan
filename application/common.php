<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 获取有赞accessToken
 */
function getAccessToken()
{
    require_once '../vendor/autoload.php';
    //有赞商家应用信息
    $clientId = "566dc8b69b401aa19a";
    $clientSecret = "934fabe6cae24bd1ba80243b33151473";
    // 获取AccessToken
    $type = 'silent';
    $keys['kdt_id'] = '43817103';

    $accessToken = (new \Youzan\Open\Token($clientId, $clientSecret))->getToken($type, $keys);
    if($accessToken['access_token']) return $accessToken['access_token'];
    return "token获取失败";
}

/**
 * 获取客户端ip
 */
function getClientIp()
{
    return request()->ip();
}

function getUserInfo()
{

}

/**
 * 生成邀请码
 */
function getInviteCode()
{
    return substr(md5(microtime()),-6,6);
}