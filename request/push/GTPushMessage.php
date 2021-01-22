<?php
require_once(dirname(__FILE__) . '/' . 'GTRevoke.php');
require_once(dirname(__FILE__) . '/' . 'GTNotification.php');

class GTPushMessage extends GTApiRequest
{
    /**
     * 通知展示时间段，格式为毫秒时间戳段，两个时间的时间差必须大于10分钟，例如："1590547347000-1590633747000"
     */
    private $duration;

    /**
     * 个推通知消息内容，与{@link #transmission}、{@link #revoke} 三选一
     */
    private $notification;

    /**
     * 透传消息内容，与{@link #notification}、{@link #revoke} 三选一
     */
    private $transmission;

    /**
     * 撤回消息，撤回消息不能与{@link #notification}和{@link #transmission}并存
     */
    private $revoke;

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        $this->apiParam["duration"] = $duration;
    }

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

    public function getRevoke()
    {
        return $this->revoke;
    }

    public function setRevoke($revoke)
    {
        $this->revoke = $revoke;
    }

    public function getApiParam()
    {
        if ($this->notification != null){
            $this->apiParam["notification"] = $this->notification->getApiParam();
        }
        if ($this->revoke != null){
            $this->apiParam["revoke"] = $this->revoke->getApiParam();
        }
        return $this->apiParam;
    }

}