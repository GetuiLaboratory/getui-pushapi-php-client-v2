<?php

class GTConfig
{

    public static function isNeedOSAsigned()
    {
        return "true" == GTConfig::getProperty("getui_isNeedAssign", "false");
    }

    public static function getHttpProxyIp()
    {
        return GTConfig::getProperty("getui_http_proxy_ip");
    }

    public static function getHttpProxyPort()
    {
        return (int)GTConfig::getProperty("getui_http_proxy_port", 80);
    }

    public static function getHttpProxyUserName()
    {
        return GTConfig::getProperty("getui_http_proxy_username");
    }

    public static function getHttpProxyPasswd()
    {
        return GTConfig::getProperty("getui_http_proxy_passwd");
    }

    public static function getHttpConnectionTimeOut()
    {
        return (int)GTConfig::getProperty("getui_http_connecton_timeout", 60000);
    }

    public static function getHttpInspectInterval()
    {
        return (int)GTConfig::getProperty("getui_inspect_interval", 300000);
    }


    public static function getHttpSoTimeOut()
    {
        return (int)GTConfig::getProperty("getui_http_so_timeout", 30000);
    }

    public static function getHttpTryCount()
    {
        return (int)GTConfig::getProperty("getui_http_tryCount", 3);
    }

    public static function getDefaultDomainUrl($useSSL)
    {
        $urlStr = GTConfig::getProperty("getui_default_domainurl");
        if ($urlStr == null || "" . equals(trim($urlStr))) {
            if ($useSSL) {
                $hosts = array("https://restapi.getui.com", "https://cncrestapi.getui.com",
                    "https://nzrestapi.getui.com");
            } else {
                $hosts = array("http://restapi.getui.com", "http://cncrestapi.getui.com",
                    "http://nzrestapi.getui.com");
            }
        } else {
            $list = explode(",", $urlStr);
            $hosts = array();
            foreach ($list as $value) {
                if (strpos($value, "https://") === 0 && !$useSSL) {
                    continue;
                }
                if (strpos($value, "http://") === 0 && $useSSL) {
                    continue;
                }
                if ($useSSL && strpos($value, "http") != 0) {
                    $value = "https://" . $value;
                }
                array_push($hosts, $value);
            }
        }
        return $hosts;
    }

    private static function getProperty($key, $defaultValue = null)
    {
        $value = getenv($key);
        if ($value != null) {
            return $value;
        } else {
            return $defaultValue;
        }
    }

    public static function getSDKVersion()
    {
        return "1.0.0.0";
    }
}