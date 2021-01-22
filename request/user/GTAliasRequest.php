<?php

require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');
require_once(dirname(__FILE__) . '/' . '../user/GTCidAlias.php');


class GTAliasRequest extends GTApiRequest
{
    //dataList	Json Array	数据列表，数组长度不大于200
    private $dataList = array();

    public function getDataList()
    {
        return $this->dataList;
    }

    //添加单个CidAlias
    public function addDataList($cidAlias)
    {
        array_push($this->dataList, $cidAlias);
    }

    //set CidAlias数组
    public function setDataList($cidAliasList)
    {
        $this->dataList = $cidAliasList;
    }

    public function getApiParam()
    {
        $this->apiParam["data_list"] = array();
        foreach ($this->dataList as $value) {
            array_push($this->apiParam["data_list"], $value->getApiParam());
        }
        return $this->apiParam;
    }
}