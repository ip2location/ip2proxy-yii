<?php
namespace IP2ProxyYii;

use Yii;

// Web Service Settings
if(defined('IP2LOCATION_IO_API_KEY')) {
	define('USE_IO', true);
} else  {
	define('USE_IO', false);
	if(!defined('IP2PROXY_API_KEY')) {
		define('IP2PROXY_API_KEY', 'demo');
	}

	if(!defined('IP2PROXY_PACKAGE')) {
		define('IP2PROXY_PACKAGE', 'PX1');
	}

	if(!defined('IP2PROXY_USESSL')) {
		define('IP2PROXY_USESSL', false);
	}
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
		if (USE_IO) {
			// Using IP2Location.io API
			$ioapi_baseurl = 'https://api.ip2location.io/?';
			$params = [
				'key'     => IP2LOCATION_IO_API_KEY,
				'ip'      => $ip,
				'lang'    => ((defined('IP2LOCATION_IO_LANGUAGE')) ? IP2LOCATION_IO_LANGUAGE : ''),
			];
			// Remove parameters without values
			$params = array_filter($params);
			$url = $ioapi_baseurl . http_build_query($params);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			$response = curl_exec($ch);

			if (!curl_errno($ch)) {
				if (($data = json_decode($response, true)) === null) {
					return false;
				}
				if (array_key_exists('error', $data)) {
					throw new \Exception(__CLASS__ . ': ' . $data['error']['error_message'], $data['error']['error_code']);
				}
				return $data;
			}

			curl_close($ch);

			return false;
		} else {
			$ws = new \IP2Proxy\WebService(IP2PROXY_API_KEY, IP2PROXY_PACKAGE, IP2PROXY_USESSL);

			try {
				$records = $ws->lookup($ip);
			} catch (Exception $e) {
				return null;
			}

			return $records;
		}
    }

}
