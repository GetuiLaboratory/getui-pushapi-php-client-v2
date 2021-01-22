<?php

require_once(dirname(__FILE__) . '/' . 'GTAps.php');
require_once(dirname(__FILE__) . '/' . 'GTMultimedia.php');

class GTIos extends GTApiRequest
{
    /**
     * voip：voip语音推送，notify：apns通知消息
     */
    private $type;

    /**
     * 推送通知消息内容
     */
    private $aps;
    /**
     * 用于计算icon上显示的数字，还可以实现显示数字的自动增减，如“+1”、 “-1”、 “1” 等，计算结果将覆盖badge
     */
    private $autoBadge;
    /**
     * 增加自定义的数据
     */
    private $payload;
    /**
     * 多媒体设置
     */
    private $multimedia;

    //使用相同的apns-collapse-id可以覆盖之前的消息
    private $apnsCollapseId;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParam["type"] = $type;
    }

    public function getAps()
    {
        return $this->aps;
    }

    public function setAps($aps)
    {
        $this->aps = $aps;
    }

    public function getAutoBadge()
    {
        return $this->autoBadge;
    }

    public function setAutoBadge($autoBadge)
    {
        $this->autoBadge = $autoBadge;
        $this->apiParam["auto_badge"] = $autoBadge;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
        $this->apiParam["payload"] = $payload;
    }

    public function getMultimedia()
    {
        return $this->multimedia;
    }

    public function setMultimedia($multimedia)
    {
        $this->multimedia = $multimedia;
    }

    public function addMultimedia($multimedia)
    {
        if (empty($this->multimedia)) {
            $this->multimedia = array($multimedia);
        } else {
            array_push($this->multimedia, $multimedia);
        }
    }

    public function getApnsCollapseId()
    {
        return $this->apnsCollapseId;
    }

    public function setApnsCollapseId($apnsCollapseId)
    {
        $this->apnsCollapseId = $apnsCollapseId;
        $this->apiParam["apns-collapse-id"] = $apnsCollapseId;
    }

    public function getApiParam()
    {
        if ($this->multimedia != null){
            $this->apiParam["multimedia"] = array();
            foreach ($this->multimedia as $value) {
                array_push($this->apiParam["multimedia"], $value->getApiParam());
            }
        }
        if ($this->aps != null){
            $this->apiParam["aps"] = $this->aps->getApiParam();
        }
        return $this->apiParam;
    }
}