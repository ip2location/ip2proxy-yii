<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IP2ProxyYii\IP2Proxy_Yii;

class FunctionTest extends TestCase
{
	public function testGetDb() {
		define('IP2PROXY_DATABASE', './database/IP2PROXY.BIN');
		$IP2Proxy = new IP2Proxy_Yii();
		$record = $IP2Proxy->get('1.0.241.135');

		$this->assertEquals(
			'TH',
			$record['countryCode'],
		);
	}

	public function testGetWebService() {
		$IP2Proxy = new IP2Proxy_Yii();
		$record = $IP2Proxy->getWebService('1.0.241.135');

		$this->assertEquals(
			'TH',
			$record['countryCode'],
		);
	}
}