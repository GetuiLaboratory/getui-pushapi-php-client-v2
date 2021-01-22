<?php
require_once(dirname(__FILE__) . '/' . 'GTThirdNotification.php');

class GTUps extends GTApiRequest
{
    /**
     * 通知消息内容，与transmission 二选一，两个都填写时报错
     */
    private $notification;
    /**
     * 透传消息内容，与notification 二选一，两个都填写时报错，长度 ≤ 3072
     */
    private $transmission;

    /**
     * 第三方厂商通知扩展内容
     *
     * $constraint，扩展内容对应厂商通道设置如：HW,MZ,...,不填默认ALL
     *
     * 厂商内容扩展字段,单个厂商特有字段，
     * key目前支持的所有字段:
     * hw角标设置：badgeAddNum，
     * badgeClass要设置hw角标，这两个字段需要配合使用 ，hw的icon
     * op私信 channel，op的消息去重 app_meaasge_id，
     * vv的消息分类classification， 0 代表运营消息，1代表系统消息，不填默认为0。
     * xm的channel:目前只有op和xm支持
     *
     * value的设置根据key值决定。例如，
     * hw角标设置：key设为badgeAddNum，value：1（原来的角标值+1）key设为badgeClass，value：请写入角标设置的应用类名）
     * key设为icon，value：请写⼊对应图标地址
     */
    private $options;

    public function getNotification()
    {
        return $this->notification;
    }

    public function setNotification($notification)
    {
        $this->notification = $notification;
    }

    public function getTransmission()
    {
        return $this->transmission;
    }

    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;
        $this->apiParam["transmission"] = $transmission;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function addOption($constraint, $key, $value){
        if ($constraint == null){
            $constraint = "ALL";
        }
            $this->options[$constraint][$key] = $value;
    }
//
//    public function addOptions($option)
//    {
//        if ($this->options == null) {
//            $this->options = array($option);
//        } else {
//            array_push($this->options, $option);
//        }
//    }

    public function getApiParam()
    {
        if ($this->notification != null) {
            $this->apiParam["notification"] = $this->notification->getApiParam();
        }
        if ($this->options != null) {
            $this->apiParam["options"] = $this->options;
        }
        return $this->apiParam;
    }
}