<?php
class GTAlert extends GTApiRequest
{
    /**
     * 通知消息标题
     */
    private $title;
    /**
     * 通知消息内容
     */
    private $body;
    /**
     * (用于多语言支持)指定执行按钮所使用的Localizable.strings
     */
    private $actionLocKey;
    /**
     * (用于多语言支持)指定Localizable.strings文件中相应的key
     */
    private $locKey;
    /**
     * 如果loc-key中使用了占位符，则在loc-args中指定各参数
     */
    private $locArgs;
    /**
     * 指定启动界面图片名
     */
    private $launchImage;
    /**
     * (用于多语言支持）对于标题指定执行按钮所使用的Localizable.strings,仅支持iOS8.2以上版本
     */
    private $titleLocKey;
    /**
     * 对于标题,如果loc-key中使用的占位符，则在loc-args中指定各参数,仅支持iOS8.2以上版本
     */
    private $titleLocArgs;
    /**
     * 通知子标题,仅支持iOS8.2以上版本
     */
    private $subtitle;
    /**
     * 当前本地化文件中的子标题字符串的关键字,仅支持iOS8.2以上版本
     */
    private $subtitleLocKey;
    /**
     * 当前本地化子标题内容中需要置换的变量参数 ,仅支持iOS8.2以上版本
     */
    private $subtitleLocArgs;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParam["title"] = $title;
    }


    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        $this->apiParam["body"] = $body;
    }

    public function getActionLocKey()
    {
        return $this->actionLocKey;
    }

    public function setActionLocKey($actionLocKey)
    {
        $this->actionLocKey = $actionLocKey;
        $this->apiParam["action-loc-key"] = $actionLocKey;
    }

    public function getLocKey()
    {
        return $this->locKey;
    }

    public function setLocKey($locKey)
    {
        $this->locKey = $locKey;
        $this->apiParam["loc-key"] = $locKey;
    }

    public function getLocArgs()
    {
        return $this->locArgs;
    }

    public function setLocArgs($locArgs)
    {
        $this->locArgs = $locArgs;
    }

    public function getLaunchImage()
    {
        return $this->launchImage;
    }

    public function setLaunchImage($launchImage)
    {
        $this->launchImage = $launchImage;
        $this->apiParam["launch-image"] = $launchImage;
    }

    public function getTitleLocKey()
    {
        return $this->titleLocKey;
    }

    public function setTitleLocKey($titleLocKey)
    {
        $this->titleLocKey = $titleLocKey;
        $this->apiParam["title-loc-key"] = $titleLocKey;
    }

    public function getTitleLocArgs()
    {
        return $this->titleLocArgs;
    }

    public function setTitleLocArgs($titleLocArgs)
    {
        $this->titleLocArgs = $titleLocArgs;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        $this->apiParam["subtitle"] = $subtitle;
    }

    public function getSubtitleLocKey()
    {
        return $this->subtitleLocKey;
    }

    public function setSubtitleLocKey($subtitleLocKey)
    {
        $this->subtitleLocKey = $subtitleLocKey;
        $this->apiParam["subtitle-loc-key"] = $subtitleLocKey;
    }

    public function getSubtitleLocArgs()
    {
        return $this->subtitleLocArgs;
    }

    public function setSubtitleLocArgs($subtitleLocArgs)
    {
        $this->subtitleLocArgs = $subtitleLocArgs;
    }

    public function getApiParam()
    {
        if ($this->subtitleLocArgs != null){
            $this->apiParam["subtitle-loc-args"] = $this->subtitleLocArgs;
        }
        if ($this->titleLocArgs != null){
            $this->apiParam["title-loc-args"] = $this->titleLocArgs;
        }
        if ($this->locArgs != null){
            $this->apiParam["loc-args"] = $this->locArgs;
        }
        return $this->apiParam;
    }

}