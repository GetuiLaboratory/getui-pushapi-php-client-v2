<?php

require_once(dirname(__FILE__) . '/' . 'utils/GtHttpManager.php');
require_once(dirname(__FILE__) . '/' . 'utils/GtConfig.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtAliasRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/auth/GtAuthRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtTagSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtBadgeSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtUserQueryRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtPushRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtPushBatchRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtAudienceRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtSettings.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtStrategy.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtNotification.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GTRevoke.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtPushChannel.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GTIos.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GtAps.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GtAlert.php');
require_once(dirname(__FILE__) . '/' . 'request/push/ios/GtMultimedia.php');
require_once(dirname(__FILE__) . '/' . 'request/GtApiRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GtAndroid.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GtUps.php');
require_once(dirname(__FILE__) . '/' . 'request/push/android/GtThirdNotification.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtCondition.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtUserQueryRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtPushRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtPushBatchRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtAudienceRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/user/GtTagBatchSetRequest.php');
require_once(dirname(__FILE__) . '/' . 'request/push/GtCondition.php');
require_once(dirname(__FILE__) . '/' . 'GtPushApi.php');
require_once(dirname(__FILE__) . '/' . 'GtStatisticsApi.php');
require_once(dirname(__FILE__) . '/' . 'GtPushApi.php');
require_once(dirname(__FILE__) . '/' . 'GtUserApi.php');

/**
 * 个推客户端，用于进行推送、用户设置、报表查询等操作
 * 每new一个GTclient对象，会进行一次鉴权，建议用户保存GTclient对象重复使用。
 **/
class GtClient
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
        $this->pushApi = new GtPushApi($this);
        $this->statisticsApi = new GtStatisticsApi($this);
        $this->userApi = new GtUserApi($this);

        $domainUrl = trim($domainUrl);
        if ($ssl == NULL && $domainUrl != NULL && strpos(strtolower($domainUrl), "https:") === 0) {
            $ssl = true;
        }

        $this->useSSL = ($ssl == NULL ? false : $ssl);

        if ($domainUrl == NULL || strlen($domainUrl) == 0) {
            $this->domainUrlList = GtConfig::getDefaultDomainUrl($this->useSSL);
        } else {
            if (GtConfig::isNeedOSAsigned()) {
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
        $auth = new GtAuthRequest();
        $auth->setAppkey(APPKEY);
        $timeStamp = $this->getMicroTime();
        $sign = hash("sha256", APPKEY . $timeStamp . MS);
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