<?php
/**
 * Created by PhpStorm.
 * User: huaminghui
 * Date: 2019/10/31
 * Time: 6:11 PM
 */

namespace Jushuitan;


class BaseJushuitan
{
    // 初始化 参数
    protected function __construct(){}

    protected function POST($url, $data = [])
    {
        if ($url['error'] !== 1) return ['error'=>-1,'msg'=>$url['msg']];
        try {
            if (empty($data))
            {
                $data = (object)[];
            }

            $ch = curl_init($url['url']);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

            $result = curl_exec($ch);
            if ($result === false)
            {
                $msg = curl_error($ch);
            }else{
                $msg = '成功';
            }
            curl_close($ch);

            return ['error'=>-1,'msg'=>$msg,'data'=>json_decode($result,true)];
        } catch(Exception $e) {
            return ['error'=>-1,'msg'=>$e->getMessage()];
        }

    }

}