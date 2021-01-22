<?php
require_once(dirname(__FILE__) . '/' . 'GTStrategy.php');


class GTSettings extends GTApiRequest
{
    /**
     * 消息离线时间设置，单位毫秒，-1表示不设离线, -1 ～ 3 * 24 * 3600 * 1000之间
     */
    private $ttl;
    /**
     * 厂商通道策略
     */
    private $strategy;
    /**
     * 推送速度
     */
    private $speed;
    /**
     * 定时推送时间，格式：毫秒时间戳
     */
    private $scheduleTime;

    public function getTtl()
    {
        return $this->ttl;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        $this->apiParam["ttl"] = $ttl;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
        $this->apiParam["speed"] = $speed;
    }

    public function getScheduleTime()
    {
        return $this->scheduleTime;
    }

    public function setScheduleTime($scheduleTime)
    {
        $this->scheduleTime = $scheduleTime;
        $this->apiParam["schedule_time"] = $scheduleTime;
    }

    public function getApiParam()
    {
        if ($this->strategy != null){
            $this->apiParam["strategy"] = $this->strategy->getApiParam();
        }
        return $this->apiParam;
    }
}