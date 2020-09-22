<?php
namespace IP2ProxyYii;

use Yii;

// Web Service Settings
if(!defined('IP2PROXY_API_KEY')) {
	define('IP2PROXY_API_KEY', 'demo');
}

if(!defined('IP2PROXY_PACKAGE')) {
	define('IP2PROXY_PACKAGE', 'PX1');
}

if(!defined('IP2PROXY_USESSL')) {
	define('IP2PROXY_USESSL', false);
}


class IP2Proxy_Yii
{

    public function get($ip, $query = array())
    {
        $obj = new \IP2Proxy\Database();
        $obj->open(IP2PROXY_DATABASE, \IP2Proxy\Database::FILE_IO);

        try {
            $records = $obj->getAll($ip);
        } catch (Exception $e) {
            return null;
        }

        $obj->close();
        return $records;
    }

    public function getWebService($ip)
    {
        $ws = new \IP2Proxy\WebService(IP2PROXY_API_KEY, IP2PROXY_PACKAGE, IP2PROXY_USESSL);

        try {
            $records = $ws->lookup($ip);
        } catch (Exception $e) {
            return null;
        }

        return $records;
    }

}
