<?php

require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');
require_once(dirname(__FILE__) . '/' . 'GTPushMessage.php');
require_once(dirname(__FILE__) . '/' . 'GTPushChannel.php');
require_once(dirname(__FILE__) . '/' . 'GTSettings.php');

class GTPushRequest extends GTApiRequest
{
    /**
     * 请求唯一标识号(10-32位之间)
     */
    private $requestId;
    //任务组名
    private $groupName;
    //推送条件设置
    private $settings;
    //个推推送消息参数，详细内容见http://docs.getui.com/getui/server/rest_v2/common_args/?id=doc-title-6
    private $pushMessage;
    //厂商推送消息参数，包含ios消息参数，android厂商消息参数，详细内容见http://docs.getui.com/getui/server/rest_v2/common_args/?id=doc-title-7
    private $pushChannel;
    //设置cid，用于cid单推和批量cid单推
    private $cid;
    //设置别名，用于别名单推和批量别名单推
    private $alias;
    //设置cid列表，用于tolist-cid批量推送
    private $cidList;
    //设置别名列表，用于tolist-别名批量推送
    private $aliasList;
    //对指定应用的符合筛选条件的用户群发推送消息。支持定时、定速功能。
    private $tagList;
    //根据标签过滤用户并推送。支持定时、定速功能。用于使用标签快速推送
    private $fastCustomTag;

    public function getFastCustomTag()
    {
        return $this->fastCustomTag;
    }

    public function setFastCustomTag($fastCustomTag)
    {
        $this->fastCustomTag = $fastCustomTag;
    }

    public function getTagList()
    {
        return $this->tagList;
    }

    public function setTagList($tagList)
    {
        $this->tagList = $tagList;
    }

    public function getAliasList()
    {
        return $this->aliasList;
    }

    public function setAliasList($aliasList)
    {
        $this->aliasList = $aliasList;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;

    }

    public function getCidList()
    {
        return $this->cidList;
    }

    public function setCidList($cidList)
    {
        $this->cidList = $cidList;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        $this->apiParam["request_id"] = $requestId;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        $this->apiParam["group_name"] = $groupName;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function getPushMessage()
    {
        return $this->pushMessage;
    }

    public function setPushMessage($pushMessage)
    {
        $this->pushMessage = $pushMessage;
    }

    public function getPushChannel()
    {
        return $this->pushChannel;
    }

    public function setPushChannel($pushChannel)
    {
        $this->pushChannel = $pushChannel;
    }

    public function getApiParam()
    {
        if ($this->pushMessage != null){
            $this->apiParam["push_message"] = $this->pushMessage->getApiParam();
        }
        if ($this->pushChannel){
            $this->apiParam["push_channel"] = $this->pushChannel->getApiParam();
        }
        if ($this->settings){
            $this->apiParam["settings"] = $this->settings->getApiParam();
        }

        $this->apiParam["audience"] = "all";
        if ($this->cid != null) {
            $audience["cid"] = array($this->cid);
            $this->apiParam["audience"] = $audience;
        }
        if ($this->alias != null) {
            $audience["alias"] = array($this->alias);
            $this->apiParam["audience"] = $audience;
        }
        if ($this->cidList != null) {
            $audience["cid"] = $this->cidList;
            $this->apiParam["audience"] = $audience;
        }
        if ($this->aliasList != null) {
            $audience["alias"] = $this->aliasList;
            $this->apiParam["audience"] = $audience;
        }
        if ($this->tagList != null) {
            $audience["tag"] = array();
            foreach ($this->tagList as $v) {
                array_push($audience["tag"], $v->getApiParam());
            }
            $this->apiParam["audience"] = $audience;
        }
        if ($this->fastCustomTag != null) {
            $audience["fast_custom_tag"] = $this->fastCustomTag;
            $this->apiParam["audience"] = $audience;
        }
        return $this->apiParam;
    }
}
