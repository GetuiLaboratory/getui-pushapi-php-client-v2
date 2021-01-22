<?php
require_once(dirname(__FILE__) . '/' . '../GTApiRequest.php');

class GTBadgeSetRequest extends GTApiRequest{

    /** 用户应用icon上显示的数字
     * +N: 在原有badge上+N
     * -N: 在原有badge上-N
     * N: 直接设置badge(数字，会覆盖原有的badge值)
     */
    private $badge;
    //用户标识，多个以英文逗号隔开，一次最多传200个
    private $cids;

    public function getBadge()
    {
        return $this->badge;
    }

    public function setBadge($badge)
    {
        $this->badge = $badge;
        $this->apiParam["badge"] = $badge;
    }
    
    public function getCids()
    {
        return $this->cids;
    }

    public function setCids($cids)
    {
        $this->cids = $cids;
    }
}
