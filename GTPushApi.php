<?php

require_once(dirname(__FILE__) . '/' . 'GTBaseApi.php');

/**
 * 推送相关api，官网文档路径：http://docs.getui.com/getui/server/rest_v2/push/
 **/

class GTPushApi extends GTBaseApi
{

    public function __construct($gtClient){
        $this->gtClient = $gtClient;
    }

    //向单个用户推送消息，可根据cid指定用户
    function pushToSingleByCid($params){
        return $this->post("/push/single/cid", $params->getApiParam());
    }

    function pushToSingleByAlias($params){
        return $this->post("/push/single/alias", $params->getApiParam());
    }

    function pushBatchByCid($params){
        return $this->post("/push/single/batch/cid", $params->getApiParam());
    }

    function pushBatchByAlias($params){
        return $this->post("/push/single/batch/alias", $params->getApiParam());
    }

    function createListMsg($params){
        return $this->post("/push/list/message", $params->getApiParam());
    }

    function pushListByCid($params){
        return $this->post("/push/list/cid", $params->getApiParam());
    }

    function pushListByAlias($params){
        return $this->post("/push/list/alias", $params->getApiParam());
    }

    function pushAll($params){
        return $this->post("/push/all", $params->getApiParam());
    }

    function pushByTag($params){
        return $this->post("/push/tag", $params->getApiParam());
    }

    function pushByFastCustomTag($params){
        return $this->post("/push/fast_custom_tag", $params->getApiParam());
    }

    //停止任务
    function stopPush($params)
    {
        return $this->delete("/task/" . $params, null);
    }

    //查询定时任务状态
    function queryScheduleTask($params)
    {
        return $this->get("/task/schedule/" . $params, null);
    }

    //删除定时任务
    function deleteScheduleTask($params)
    {
        return $this->delete("/task/schedule/" . $params, null);
    }
}