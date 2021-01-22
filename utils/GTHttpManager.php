<?php

require_once(dirname(__FILE__) . '/' . '../exception/GTException.php');

class GTHttpManager
{
    const HTTP_METHOD_POST = "post";
    const HTTP_METHOD_PUT = "put";
    const HTTP_METHOD_GET = "get";
    const HTTP_METHOD_DELETE = "del";

    static $curls = array();

    private static function request($url, $data, $gzip, $method,$headers)
    {
        if(!isset(GTHttpManager::$curls[$url])){
            $curl = curl_init($url);
            GTHttpManager::$curls[$url] = $curl;
        }
        $curl = GTHttpManager::$curls[$url];
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'GeTui RAS2 PHP/1.0');
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 0);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, GTConfig::getHttpConnectionTimeOut());
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, GTConfig::getHttpSoTimeOut());
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $header = null;
        if ($headers != null){
            array_push($headers,"Content-Type:application/json;charset=UTF-8", "Connection: Keep-Alive");
            $header = $headers;
        }else{
            $header = array("Content-Type:application/json;charset=UTF-8", "Connection: Keep-Alive");
        }
        if ($gzip) {
            $data = gzencode($data, 9);
            array_push($header,'Accept-Encoding:gzip');
            array_push($header,'Content-Encoding:gzip');
            curl_setopt($curl, CURLOPT_ENCODING, "gzip");
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
        switch ($method){
            case self::HTTP_METHOD_GET:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                break;
            case self::HTTP_METHOD_POST:
                //post
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case self::HTTP_METHOD_DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case self::HTTP_METHOD_PUT:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST,"PUT"); //设置请求方式
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
        }
        $curl_version = curl_version();
        if ($curl_version['version_number'] >= 462850) {
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, 30000);
            curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
        }
       // 通过代理访问接口需要在此处配置代理
        curl_setopt ($curl, CURLOPT_PROXY, GTConfig::getHttpProxyIp());
        curl_setopt($curl,CURLOPT_PROXYPORT,GTConfig::getHttpProxyPort());
        curl_setopt($curl, CURLOPT_PROXYUSERNAME, GTConfig::getHttpProxyUserName());
        curl_setopt($curl, CURLOPT_PROXYPASSWORD, GTConfig::getHttpProxyPasswd());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // return don't print
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //设置超时时间
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        curl_setopt($curl, CURLOPT_MAXREDIRS, 7); //HTTp定向级别
        //请求失败有3次重试机会
        $result = GTHttpManager::exeBySetTimes(GTConfig::getHttpTryCount(), $curl);
        return $result;
    }

    public static function httpRequest($url, $params,$headers, $gzip = false, $method)
    {
        $data = json_encode($params);
        $result = null;
        try {
            $resp = GTHttpManager::request($url, $data, $gzip,$method,$headers);
            $result = json_decode($resp, true);
            return $result;
        } catch (Exception $e) {
            throw new GTException($params["request_id"],"httpPost:[".$url."] [" .$data." ] [ ".$result."]:",$e);
        }
    }

    private static function exeBySetTimes($count, $curl)
    {
        $result = curl_exec($curl);
		$info = curl_getinfo($curl);
		$code = $info["http_code"];
        if (curl_errno($curl) != 0 && $code != 200) {
			$count--;
            if ($count > 0) {
                $result = GTHttpManager::exeBySetTimes($count, $curl);
            } else {
                if ($code == 0 || $code == 404 || $code == 504){
                    throw new GTException("connect failed, code = ".strval($code));
                }
            }
        }
        return $result;
    }
}