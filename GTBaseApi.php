<?php

class GTBaseApi
{
    protected $gtClient;

    protected function post($api, $params)
    {
        return $this->httpRequest($api, $params, GTHttpManager::HTTP_METHOD_POST);
    }

    protected function put($api, $params)
    {
        return $this->httpRequest($api, $params, GTHttpManager::HTTP_METHOD_PUT);
    }

    protected function get($api, $params)
    {
        return $this->httpRequest($api, $params, GTHttpManager::HTTP_METHOD_GET);
    }

    protected function delete($api, $params)
    {
        return $this->httpRequest($api, $params, GTHttpManager::HTTP_METHOD_DELETE);
    }

    private function httpRequest($api, $params, $method, $gzip = false)
    {
        try {
            $rep = GTHttpManager::httpRequest($this->getUrl($api), $params, $this->buildHead(), $gzip, $method);
        } catch (GTException $e) {
            throw $e;
        }
        if ($rep != null) {
            if ('10001' == $rep['code']) {
                try {
                    if ($this->gtClient->auth()) {
                        $rep = GTHttpManager::httpRequest($this->getUrl($api), $params, $this->buildHead(), $gzip, $method);
                    }
                } catch (GTException $e) {
                    throw $e;
                }
            } else if ('301' == $rep['code']) {
                if (empty($rep["data"]) || empty($rep["data"]["host_list"]) || empty($rep["data"]["host_list"][0]["domain_list"])) {
                    throw new GTException("域名错误");
                }
                $this->gtClient->setDomainUrlList($rep["data"]["host_list"][0]["domain_list"]);
                try {
                    $rep = GTHttpManager::httpRequest($this->getUrl($api), $params, $this->buildHead(), $gzip, $method);
                } catch (GTException $e) {
                    throw $e;
                }
            }
        }
        return $rep;
    }

    private function analysisUrlList()
    {

    }

    private function buildHead()
    {
        $headers = array();
        if ($this->gtClient->getAuthToken() != null) {
            array_push($headers, "token:" . $this->gtClient->getAuthToken());
        }
        return $headers;
    }

    private function getUrl($api)
    {
        return $this->gtClient->getHost() . "/v2/" . $this->gtClient->getAppId() . $api;
    }
}