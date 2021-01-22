<?php
require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');
class GTCidAlias extends GTApiRequest
{
    //cid，用户标识
    public $cid;
    /** 别名，有效的别名组成：
     * 字母（区分大小写）、数字、下划线、汉字;
     * 长度<40;
     * 一个别名最多允许绑定10个cid。
     */
    public $alias;

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
        $this->apiParam["cid"] = $cid;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
        $this->apiParam["alias"] = $alias;
    }
}