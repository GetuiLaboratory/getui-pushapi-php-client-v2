<?php

require_once(dirname(__FILE__) . '/' . 'utils/GTHttpManager.php');
require_once(dirname(__FILE__) . '/' . 'utils/GTConfig.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTAliasRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/auth/GTAuthRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTTagSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTBadgeSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTUserQueryRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTPushRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTPushBatchRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTAudienceRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTSettings.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTStrategy.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTNotification.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTRevoke.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTPushChannel.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GTIos.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GTAps.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GTAlert.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GTMultimedia.php');
require_once(dirname(__FILE__) . '/' . 'request/GTApiRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GTAndroid.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GTUps.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GTThirdNotification.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTCondition.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTUserQueryRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTPushRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTPushBatchRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTAudienceRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GTTagBatchSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTCondition.php');
require_once(dirname(__FILE__) . '/' . 'GTPushApi.php');
require_once(dirname(__FILE__) . '/' . 'GTStatisticsApi.php');
require_once(dirname(__FILE__) . '/' . 'GTPushApi.php');
require_once(dirname(__FILE__) . '/' . 'GTUserApi.php');

/**
 * 个推客户端，用于进行推送、用户设置、报表查询等操作
 * 每new一个GTclient对象，会进行一次鉴权，建议用户保存GTclient对象重复使用。
 **/
class GTClient
{
    //第三方 标识
    private $appkey;
    //第三方 密钥
    private $masterSecret;
    //鉴权token
    private $authToken;
    //第三方 appid
    private $appId;

    //是否使用https连接 以该标志为准
    private $useSSL = null;
    //用户配置或者内置域名列表
    private $domainUrlList = null;
    //是否指定域名。如果指定，使用过程中域名不会发生变化
    private $isAssigned = false;

    //推送api
    private $pushApi = null;
    //报表api
    private $statisticsApi = null;
    //用户api
    private $userApi = null;

    public function __construct($domainUrl, $appkey, $appId, $masterSecret, $ssl = NULL)
    {
        $this->appkey = $appkey;
        $this->masterSecret = $masterSecret;
        $this->appId = $appId;
        $this->pushApi = new GTPushApi($this);
        $this->statisticsApi = new GTStatisticsApi($this);
        $this->userApi = new GTUserApi($this);

        $domainUrl = trim($domainUrl);
        if ($ssl == NULL && $domainUrl != NULL && strpos(strtolower($domainUrl), "https:") === 0) {
            $ssl = true;
        }

        $this->useSSL = ($ssl == NULL ? false : $ssl);

        if ($domainUrl == NULL || strlen($domainUrl) == 0) {
            $this->domainUrlList = GTConfig::getDefaultDomainUrl($this->useSSL);
        } else {
            if (GTConfig::isNeedOSAsigned()) {
                $this->isAssigned = true;
            }
            $this->domainUrlList = array($domainUrl);
        }
        //鉴权
        try {
            $this->auth();
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
    }

    public function pushApi()
    {
        return $this->pushApi;
    }

    public function statisticsApi()
    {
        return $this->statisticsApi;
    }

    public function userApi()
    {
        return $this->userApi;
    }


    public function getHost()
    {
        return $this->domainUrlList[0];
    }

    public function setDomainUrlList($domainUrlList)
    {
        $this->domainUrlList = $domainUrlList;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function auth()
    {
        $auth = new GTAuthRequest();
        $auth->setAppkey($this->appkey);
        $timeStamp = $this->getMicroTime();
        $sign = hash("sha256", $this->appkey . $timeStamp . $this->masterSecret);
        $auth->setSign($sign);
        $auth->setTimestamp($timeStamp);
        $rep = $this->userApi()->auth($auth);
        if ($rep["code"] == 0) {
            $this->authToken = $rep["data"]["token"];
            return true;
        }
        return false;
    }

    function getMicroTime()
    {
        list($usec, $sec) = explode(" ", microtime());
        $time = ($sec . substr($usec, 2, 3));
        return $time;
    }
}