# IP2Proxy Yii extension
IP2Proxy Yii extension enables the user to query an IP address if it was being used as open proxy, web proxy, VPN anonymizer and TOR exit nodes, search engine robots, data center ranges and residential proxies. It lookup the proxy IP address from IP2Proxy BIN Data file or web service. Developers can use the API to query all IP2Proxy BIN databases or web service for applications written using Yii.


## INSTALLATION
For Yii2

1. Run the command: `php composer.phar require ip2location/ip2proxy-yii` to download the plugin into the Yii2 framework.
2. Download latest IP2Proxy BIN database
    - IP2Proxy free LITE database at https://lite.ip2location.com
    - IP2Proxy commercial database at https://www.ip2location.com/proxy-database
3. Unzip and copy the BIN file into the Yii2 framework.

**Note:** The BIN database refers to the binary file ended with .BIN extension, but not the CSV format.
Please select the right package for download.


## USAGE
```
use IP2ProxyYii\IP2Proxy_Yii;

// (required) Define IP2Proxy database path.
define('IP2PROXY_DATABASE', '/path/to/ip2proxy/database');

// (required) Define IP2Proxy API key.
define('IP2PROXY_API_KEY', 'your_api_key');

// (required) Define IP2Proxy Web service package of different granularity of return information.
define('IP2PROXY_PACKAGE', 'PX1');

// (optional) Define to use https or http.
define('IP2PROXY_USESSL', false);

$IP2Proxy = new IP2Proxy_Yii();

$record = $IP2Proxy->get('1.0.241.135');
echo 'Result from BIN Database:<br>';
echo '<p><strong>IP Address: </strong>' . $record['ipAddress'] . '</p>';
echo '<p><strong>IP Number: </strong>' . $record['ipNumber'] . '</p>';
echo '<p><strong>IP Version: </strong>' . $record['ipVersion'] . '</p>';
echo '<p><strong>Country Code: </strong>' . $record['countryCode'] . '</p>';
echo '<p><strong>Country: </strong>' . $record['countryName'] . '</p>';
echo '<p><strong>State: </strong>' . $record['regionName'] . '</p>';
echo '<p><strong>City: </strong>' . $record['cityName'] . '</p>';
echo '<p><strong>Proxy Type: </strong>' . $record['proxyType'] . '</p>';
echo '<p><strong>Is Proxy: </strong>' . $record['isProxy'] . '</p>';
echo '<p><strong>ISP: </strong>' . $record['isp'] . '</p>';
echo '<p><strong>Domain: </strong>' . $record['domain'] . '</p>';
echo '<p><strong>Usage Type: </strong>' . $record['usageType'] . '</p>';
echo '<p><strong>ASN: </strong>' . $record['asn'] . '</p>';
echo '<p><strong>AS: </strong>' . $record['as'] . '</p>';
echo '<p><strong>Last Seen: </strong>' . $record['lastSeen'] . '</p>';
echo '<p><strong>Threat: </strong>' . $record['threat'] . '</p>';

$record = $IP2Proxy->getWebService('1.0.241.135');
echo 'Result from Web service:<br>';
echo '<pre>';
print_r ($record);
echo '</pre>';
```


## DEPENDENCIES
This library requires IP2Proxy BIN or IP2Proxy API key data file to function. You may download the BIN data file at
* IP2Proxy LITE BIN Data (Free): https://lite.ip2location.com
* IP2Proxy Commercial BIN Data (Comprehensive): https://www.ip2location.com/proxy-database

You can also sign up for [IP2Proxy Web Service](https://www.ip2location.com/web-service/ip2proxy) to get one free API key.


## SUPPORT
Email: support@ip2location.com

Website: https://www.ip2location.com
