<?php

class GTRevoke extends GTApiRequest
{
    /**
     * 在没有找到对应的taskid，是否把对应appid下所有的通知都撤回
     */
    private $force = false;
    /**
     * 根据oldTaskId进行撤回
     */
    private $oldTaskId;

    public function getForce()
    {
        return $this->force;
    }

    public function setForce($force)
    {
        $this->force = $force;
        $this->apiParam["force"] = $force;
    }

    public function getOldTaskId()
    {
        return $this->oldTaskId;
    }

    public function setOldTaskId($oldTaskId)
    {
        $this->oldTaskId = $oldTaskId;
        $this->apiParam["old_task_id"] = $oldTaskId;
    }
}