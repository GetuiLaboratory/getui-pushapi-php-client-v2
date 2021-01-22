<?php

require_once(dirname(__FILE__) . '/' . 'GTAlert.php');

class GTAps extends GTApiRequest
{
    /**
     * 通知消息
     */
    private $alert;
    /**
     * 推送直接带有透传数据，content-available=1表示静默推送，静默推送时不需要填写其他参数，详细参数填写见示例，苹果建议1小时最多推送3条静默消息
     */
    private $contentAvailable;
    /**
     * 通知铃声文件名，无声设置为“com.gexin.ios.silence”
     */
    private $sound;
    /**
     * 在客户端通知栏触发特定的action和button显示
     */
    private $category;
    //ios的远程通知通过该属性对通知进行分组，仅支持iOS 12.0以上版本
    private $threadId;


    public function getAlert()
    {
        return $this->alert;
    }

    public function setAlert($alert)
    {
        $this->alert = $alert;
    }

    public function getContentAvailable()
    {
        return $this->contentAvailable;
    }

    public function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = $contentAvailable;
        $this->apiParam["content-available"] = $contentAvailable;
    }

    public function getSound()
    {
        return $this->sound;
    }

    public function setSound($sound)
    {
        $this->sound = $sound;
        $this->apiParam["sound"] = $sound;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        $this->apiParam["category"] = $category;
    }

    public function getThreadId()
    {
        return $this->threadId;
    }

    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
        $this->apiParam["thread-id"] = $threadId;
    }

    public function getApiParam()
    {
        if ($this->alert != null){
            $this->apiParam["alert"] = $this->alert->getApiParam();
        }
        return $this->apiParam;
    }
}