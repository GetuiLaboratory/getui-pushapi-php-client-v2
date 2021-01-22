<?php

require_once(dirname(__FILE__) . '/' . 'GTBaseApi.php');

/**
 * 报表相关api，官网文档路径：http://docs.getui.com/getui/server/rest_v2/report/
 **/
class GTStatisticsApi extends GTBaseApi
{

    public function __construct($gtClient){
        $this->gtClient = $gtClient;
    }

    //查询推送数据，可查询消息有效可下发总数，消息回执总数和用户点击数等结果。支持单个taskId查询和多个taskId查询。
    //任务id，推送时返回，多个taskId以英文逗号隔开，一次最多传200个
    function queryPushResultByTaskIds($params){
        return $this->get("/report/push/task/".implode(",", $params), null);
    }

    //根据任务组名查询推送结果，返回结果包括百日内联网用户数(活跃用户数)、实际下发数、到达数、展示数、点击数。
    function queryPushResultByGroupName($params){
        return $this->get("/report/push/task_group/".$params, null);
    }

    //获取单日用户数据
    function queryUserDataByDate($params){
        return $this->get("/report/user/date/".$params, null);
    }

    //获取单日推送数据
    function queryPushResultByDate($params){
        return $this->get("/report/push/date/".$params, null);
    }

    //获取24小时在线用户数
    function queryOnlineUserData(){
        return $this->get("/report/online_user", null);
    }
}