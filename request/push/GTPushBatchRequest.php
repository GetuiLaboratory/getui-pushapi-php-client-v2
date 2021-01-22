<?php

require_once(dirname(__FILE__) . '/' . 'GTPushRequest.php');

class GTPushBatchRequest extends GTApiRequest {

    private $isAsync;
    private $msgList = array();

    public function getIsAsync()
    {
        return $this->isAsync;
    }

    public function setIsAsync($isAsync)
    {
        $this->isAsync = $isAsync;
        $this->apiParam["is_async"] = $isAsync;
    }

    public function getMsgList()
    {
        return $this->msgList;
    }

    public function addMsgList($msg)
    {
        array_push($this->msgList, $msg);
    }

    public function setMsgList($msg)
    {
        $this->msgList = $msg;
    }

    public function getApiParam()
    {
        if (!empty($this->msgList)){
            $this->apiParam["msg_list"] = array();
            foreach ($this->msgList as $value) {
                array_push($this->apiParam["msg_list"], $value->getApiParam());
            }
        }
        return $this->apiParam;
    }
}