<?php
require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');

class GTAudienceRequest extends GTApiRequest
{
    private $cidList;
    private $aliasList;
    private $taskid;
    private $isAsync;

    public function getCidList()
    {
        return $this->cidList;
    }

    public function setCidList($cidList)
    {
        $this->cidList = $cidList;
    }

    public function getAliasList()
    {
        return $this->aliasList;
    }

    public function setAliasList($aliasList)
    {
        $this->aliasList = $aliasList;
    }

    public function getTaskid()
    {
        return $this->taskid;
    }

    public function setTaskid($taskid)
    {
        $this->taskid = $taskid;
        $this->apiParam["taskid"] = $taskid;
    }

    public function getIsAsync()
    {
        return $this->isAsync;
    }

    public function setIsAsync($isAsync)
    {
        $this->isAsync = $isAsync;
        $this->apiParam["is_async"] = $isAsync;
    }

    public function getApiParam()
    {
        if ($this->aliasList != null){
            $audience["alias"] = $this->aliasList;
            $this->apiParam["audience"] = $audience;
        }
        if ($this->cidList != null){
            $audience["cid"] = $this->cidList;
            $this->apiParam["audience"] = $audience;
        }
        return $this->apiParam;
    }
}