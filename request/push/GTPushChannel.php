<?php

require_once(dirname(__FILE__) . '/' . 'ios/GTIos.php');
require_once(dirname(__FILE__) . '/' . 'android/GTAndroid.php');

class GTPushChannel extends GTApiRequest
{
    /**
     * ios通道推送消息内容
     */
    private $ios;
    /**
     * android通道推送消息内容
     */
    private $android;

    public function getIos()
    {
        return $this->ios;
    }

    public function setIos($ios)
    {
        $this->ios = $ios;
    }

    public function getAndroid()
    {
        return $this->android;
    }

    public function setAndroid($android)
    {
        $this->android = $android;
    }

    public function getApiParam()
    {
        if ($this->ios != null){
            $this->apiParam["ios"] = $this->ios->getApiParam();
        }
        if ($this->android != null){
            $this->apiParam["android"] = $this->android->getApiParam();
        }
        return $this->apiParam;
    }
}