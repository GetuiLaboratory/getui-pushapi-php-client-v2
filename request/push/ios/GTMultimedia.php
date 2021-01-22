<?php
require_once(dirname(__FILE__) . '/' . '../../GTApiRequest.php');

class GTMultimedia extends GTApiRequest
{
    /**
     * 多媒体资源地址
     */
    private $url;
    /**
     * 资源类型（1.图片，2.音频，3.视频）
     */
    private $type;
    /**
     * 是否只在wifi环境下加载，如果设置成true,但未使用wifi时，会展示成普通通知
     */
    private $onlyWifi;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->apiParam["url"] = $url;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParam["type"] = $type;
    }

    public function getOnlyWifi()
    {
        return $this->onlyWifi;
    }

    public function setOnlyWifi($onlyWifi)
    {
        $this->onlyWifi = $onlyWifi;
        $this->apiParam["only_wifi"] = $onlyWifi;
    }
}