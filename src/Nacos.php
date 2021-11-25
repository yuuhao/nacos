<?php


namespace Yoka\Nacos;

use Yoka\Nacos\Nacos\NacosConfig;
use  Yoka\Nacos\Utils\Curl;

class Nacos
{
    private static $clientClass;
    private $uri = "/nacos/v1/cs/configs";

    public static function init($host, $env, $dataId, $group, $tenant)
    {
        NacosConfig::setHost($host);
        NacosConfig::setEnv($env);
        NacosConfig::setDataId($dataId);
        NacosConfig::setGroup($group);
        NacosConfig::setTenant($tenant);

        self::$clientClass = new self();

        return self::$clientClass;
    }

    public function get($host, $dataId, $group, $tenant)
    {

        $url = $host . $this->uri;
        $getParams = [
            'tenant' => $tenant,
            'dataId' => $dataId,
            'group' => $group
        ];
        return Curl::callWebServer($url, $getParams, 'get', false, false);
    }

    public function runOnce()
    {
        return call_user_func_array([self::$clientClass, "get"], [NacosConfig::getHost(), NacosConfig::getDataId(), NacosConfig::getGroup(), NacosConfig::getTenant()]);
    }
}