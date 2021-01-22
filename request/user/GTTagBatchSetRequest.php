<?php
require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');

class GTTagBatchSetRequest extends GTApiRequest{
    //要修改标签属性的cid列表，数组长度不大于200
    private $cid;
    //用户标签，标签中不能包含空格，如果含有中文字符需要编码(UrlEncode)
    private $customTag;

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    public function getCustomTag()
    {
        return $this->customTag;
    }

    public function setCustomTag($customTag)
    {
        $this->customTag = $customTag;
    }

    public function getApiParam()
    {
        if ($this->cid != null){
            $this->apiParam["cid"] = $this->cid;
        }
        return $this->apiParam;
    }
}
