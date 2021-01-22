<?php

require_once(dirname(__FILE__) . '/' . 'GTBaseApi.php');


/**
 * 用户相关api，官网文档路径：http://docs.getui.com/getui/server/rest_v2/user/
 **/
class GTUserApi extends GTBaseApi
{

    public function __construct($gtClient){
        $this->gtClient = $gtClient;
    }

    //鉴权
    function auth($params)
    {
        return $this->post("/auth", $params->getApiParam());
    }

    //关闭鉴权，如果不传入token，则关闭该gtClient的token
    function closeAuth($params)
    {
        if($params != null){
            return $this->delete("/auth/" . $params, null);
        }else{
            return $this->delete("/auth/" . $this->gtClient->getAuthToken(), null);
        }
    }

    //用户绑定别名
    function bindAlias($params)
    {
        return $this->post("/user/alias", $params->getApiParam());
    }

    //cid查别名
    function queryAliasByCid($params)
    {
        return $this->get("/user/alias/cid/" . $params, null);
    }

    //别名查cid
    function queryCidByAlias($params)
    {
        return $this->get("/user/cid/alias/" . $params, null);
    }

    //解绑别名cid
    function unbindAlias($params)
    {
        return $this->delete("/user/alias", $params->getApiParam());
    }

    //解绑别名下所有cid
    function unbindAllAlias($params)
    {
        return $this->delete("/user/alias/" . $params, null);
    }


    //一个用户绑定一批标签，此操作为覆盖操作，会删除历史绑定的标签
    function setTagForCid($params)
    {
        return $this->post("/user/custom_tag/cid/" . $params->getCid(), $params->getApiParam());
    }

    //根据cid查询用户标签列表
    function queryUserTag($params)
    {
        return $this->get("/user/custom_tag/cid/" . $params, null);
    }

    //一批用户绑定一个标签
    function batchModifyTagForBatchCid($params)
    {
        return $this->put("/user/custom_tag/batch/" . $params->getCustomTag(), $params->getApiParam());
    }

    //解绑标签
    function unbindTag($params)
    {
        return $this->delete("/user/custom_tag/batch/" . $params->getCustomTag(), $params->getApiParam());
    }

    //将单个或多个用户加入黑名单，对于黑名单用户在推送过程中会被过滤掉
    //cid：用户标识，多个以英文逗号隔开，一次最多传200个
    function addBlackUser($params)
    {
        return $this->post("/user/black/cid/" . implode(",", $params), null);
    }

    //查询用户状态
    //cid：用户标识，多个以英文逗号隔开，一次最多传200个
    function queryUserStatus($params)
    {
        return $this->get("/user/status/" . implode(",", $params), null);
    }

    //将单个cid或多个cid用户移出黑名单，对于黑名单用户在推送过程中会被过滤掉的，不会给黑名单用户推送消息
    //cid：用户标识，多个以英文逗号隔开，一次最多传200个
    function removeBlackUser($params)
    {
        return $this->delete("/user/black/cid/" . implode(",", $params), null);
    }

    //设置角标
    function setBadge($params)
    {
        return $this->post("/user/badge/cid/" . implode(",", $params->getCids()), $params->getApiParam());
    }

    //通过指定查询条件来查询满足条件的用户数量
    function queryUserCount($params)
    {
        return $this->post("/user/count", $params->getApiParam());
    }
}