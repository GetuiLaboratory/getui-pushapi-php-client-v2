<?php
class GTNotification extends GTApiRequest
{
    /**
     * 第三方厂商通知标题，长度 ≤ 50
     */
    private $title;
    /**
     * 第三方厂商通知内容，长度 ≤ 256
     */
    private $body;
    //长文本消息内容，通知消息+长文本样式，与big_image二选一，两个都填写时报错，长度 ≤ 512
    private $bigText;
    //大图的URL地址，通知消息+大图样式， 与big_text二选一，两个都填写时报错，长度 ≤ 1024
    private $bigImage;
    //通知的图标名称，包含后缀名（需要在客户端开发时嵌入），如“push.png”，长度 ≤ 64
    private $logo;
    //通知图标URL地址，长度 ≤ 256
    private $logoUrl;
    //通知渠道id，长度 ≤ 64
    private $channelId;
    //通知渠道名称，长度 ≤ 64
    private $channelName;
    /** @var 设置通知渠道重要性（可以控制响铃，震动，浮动，闪灯等等）
     * android8.0以下
     * 0，1，2:无声音，无振动，不浮动
     * 3:有声音，无振动，不浮动
     * 4:有声音，有振动，有浮动
     * android8.0以上
     * 0：无声音，无振动，不显示；
     * 1：无声音，无振动，锁屏不显示，通知栏中被折叠显示，导航栏无logo;
     * 2：无声音，无振动，锁屏和通知栏中都显示，通知不唤醒屏幕;
     * 3：有声音，无振动，锁屏和通知栏中都显示，通知唤醒屏幕;
     * 4：有声音，有振动，亮屏下通知悬浮展示，锁屏通知以默认形式展示且唤醒屏幕;
     */
    private $channelLevel;
    /**
     * @see com.gt.sdk.dto.CommonEnum.ClickTypeEnum
     * 点击通知后续动作,
     * 目前支持5种后续动作，
     * intent：打开应用内特定页面，
     * url：打开网页地址，
     * payload：启动应用加自定义消息内容，
     * startapp：打开应用首页，
     * none：纯通知，无后续动作
     */
    private $clickType;

    /**
     * 点击通知打开应用特定页面，长度 ≤ 2048;
     * 示例：intent:#Intent;component=你的包名/你要打开的 activity 全路径;S.parm1=value1;S.parm2=value2;end
     */
    private $intent;
    /**
     * 点击通知打开链接，长度 ≤ 1024
     */
    private $url;
    /**
     * 点击通知加自定义消息，长度 ≤ 3072
     */
    private $payload;
    /**
     * 消息覆盖使用，两条消息的notify_id相同，新的消息会覆盖老的消息
     */
    private $notifyId;
    //自定义铃声，请填写文件名，不包含后缀名(需要在客户端开发时嵌入)，个推通道下发有效，客户端SDK最低要求 2.14.0.0
    private $ringName;
    /** @var 角标,
     * 必须大于0, 个推通道下发有效
     * 此属性目前仅针对华为 EMUI 4.1 及以上设备有效
     * 角标数字数据会和之前角标数字进行叠加；
     * 举例：角标数字配置1，应用之前角标数为2，发送此角标消息后，应用角标数显示为3。
     * 客户端SDK最低要求 2.14.0.0
     */
    private $badgeAddNum;


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

    public function getBigText()
    {
        return $this->bigText;
    }

    public function setBigText($bigText)
    {
        $this->bigText = $bigText;
        $this->apiParam["big_text"] = $bigText;
    }

    public function getBigImage()
    {
        return $this->bigImage;
    }

    public function setBigImage($bigImage)
    {
        $this->bigImage = $bigImage;
        $this->apiParam["big_image"] = $bigImage;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
        $this->apiParam["logo"] = $logo;
    }

    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
        $this->apiParam["logo_url"] = $logoUrl;
    }

    public function getChannelId()
    {
        return $this->channelId;
    }

    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
        $this->apiParam["channel_id"] = $channelId;
    }

    public function getChannelName()
    {
        return $this->channelName;
    }

    public function setChannelName($channelName)
    {
        $this->channelName = $channelName;
        $this->apiParam["channel_name"] = $channelName;
    }

    public function getChannelLevel()
    {
        return $this->channelLevel;
    }

    public function setChannelLevel($channelLevel)
    {
        $this->channelLevel = $channelLevel;
        $this->apiParam["channel_level"] = $channelLevel;
    }

    public function getClickType()
    {
        return $this->clickType;
    }

    public function setClickType($clickType)
    {
        $this->clickType = $clickType;
        $this->apiParam["click_type"] = $clickType;
    }

    public function getIntent()
    {
        return $this->intent;
    }

    public function setIntent($intent)
    {
        $this->intent = $intent;
        $this->apiParam["intent"] = $intent;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->apiParam["url"] = $url;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
        $this->apiParam["payload"] = $payload;
    }

    public function getNotifyId()
    {
        return $this->notifyId;
    }

    public function setNotifyId($notifyId)
    {
        $this->notifyId = $notifyId;
        $this->apiParam["notify_id"] = $notifyId;
    }

    public function getRingName()
    {
        return $this->ringName;
    }

    public function setRingName($ringName)
    {
        $this->ringName = $ringName;
        $this->apiParam["ring_name"] = $ringName;

    }

    public function getBadgeAddNum()
    {
        return $this->badgeAddNum;
    }

    public function setBadgeAddNum($badgeAddNum)
    {
        $this->badgeAddNum = $badgeAddNum;
        $this->apiParam["badge_add_num"] = $badgeAddNum;
    }


}