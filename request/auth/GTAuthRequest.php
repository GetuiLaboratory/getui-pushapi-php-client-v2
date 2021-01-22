<?php

require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');

class GTAuthRequest extends GTApiRequest
{
    //鉴权秘钥
    private $sign;
    //时间戳
    private $timestamp;
    //第三方标识
    private $appkey;

    public function getSign()
    {
        return $this->sign;
    }

    public function setSign($sign)
    {
        $this->sign = $sign;
        $this->apiParam["sign"] = $sign;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        $this->apiParam["timestamp"] = $timestamp;
    }

    public function getAppkey()
    {
        return $this->appkey;
    }

    public function setAppkey($appkey)
    {
        $this->appkey = $appkey;
        $this->apiParam["appkey"] = $appkey;
    }
}