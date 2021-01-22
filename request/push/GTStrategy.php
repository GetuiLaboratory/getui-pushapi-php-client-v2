<?php
class GTStrategy extends GTApiRequest
{
    //表示该消息在用户在线时推送个推通道，用户离线时推送厂商通道;
    const STRATEGY_GT_FIRST = 1;
    //表示该消息只通过厂商通道策略下发，不考虑用户是否在线;
    const STRATEGY_THIRD_ONLY = 2;
    //表示该消息只通过个推通道下发，不考虑用户是否在线
    const STRATEGY_GT_ONLY = 3;
    //表示该消息优先从厂商通道下发，若消息内容在厂商通道代发失败后会从个推通道下发。
    const STRATEGY_THIRD_FIRST = 4;

    private $default;
    private $ios;
    private $hw;
    private $xm;
    private $mz;
    private $op;
    private $vv;
    private $st;
    private $hx;
    private $hwq;

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default)
    {
        $this->default = $default;
        $this->apiParam["default"] = $default;
    }

    public function getIos()
    {
        return $this->ios;
    }

    public function setIos($ios)
    {
        $this->ios = $ios;
        $this->apiParam["ios"] = $ios;
    }

    public function getHw()
    {
        return $this->hw;
    }

    public function setHw($hw)
    {
        $this->hw = $hw;
        $this->apiParam["hw"] = $hw;
    }

    public function getXm()
    {
        return $this->xm;
    }

    public function setXm($xm)
    {
        $this->xm = $xm;
        $this->apiParam["xm"] = $xm;
    }

    public function getMz()
    {
        return $this->mz;
    }

    public function setMz($mz)
    {
        $this->mz = $mz;
        $this->apiParam["mz"] = $mz;
    }

    public function getOp()
    {
        return $this->op;
    }

    public function setOp($op)
    {
        $this->op = $op;
        $this->apiParam["op"] = $op;
    }

    public function getVv()
    {
        return $this->vv;
    }

    public function setVv($vv)
    {
        $this->vv = $vv;
        $this->apiParam["vv"] = $vv;
    }

    public function getSt()
    {
        return $this->st;
    }

    public function setSt($st)
    {
        $this->st = $st;
        $this->apiParam["st"] = $st;
    }

    public function getHx()
    {
        return $this->hx;
    }

    public function setHx($hx)
    {
        $this->hx = $hx;
        $this->apiParam["hx"] = $hx;
    }

    public function getHwq()
    {
        return $this->hwq;
    }

    public function setHwq($hwq)
    {
        $this->hwq = $hwq;
        $this->apiParam["hwq"] = $hwq;
    }
}