<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/12/2017
 * Time: 6:25 PM
 */

include_once '../config.php';

class cidr
{
    // convert cidr to netmask
    // e.g. 21 = 255.255.248.0
    public function cidr2netmask($cidr)
    {
        $bin = null;
        for( $i = 1; $i <= 32; $i++ )
            $bin .= $cidr >= $i ? '1' : '0';

        $netmask = long2ip(bindec($bin));

        if ( $netmask == "0.0.0.0")
            return false;

        return $netmask;
    }

    // get network address from cidr subnet
    // e.g. 10.0.2.56/21 = 10.0.0.0
    public function cidr2network($ip, $cidr)
    {
        $network = long2ip((ip2long($ip)) & ((-1 << (32 - (int)$cidr))));

        return $network;
    }

    // convert netmask to cidr
    // e.g. 255.255.255.128 = 25
    public function netmask2cidr($netmask)
    {
        $bits = 0;
        $netmask = explode(".", $netmask);

        foreach($netmask as $octect)
            $bits += strlen(str_replace("0", "", decbin($octect)));

        return $bits;
    }

    // is ip in subnet
    // e.g. is 10.5.21.30 in 10.5.16.0/20 == true
    //      is 192.168.50.2 in 192.168.30.0/23 == false
    public function cidr_match($ip, $network, $cidr)
    {
        if ((ip2long($ip) & ~((1 << (32 - $cidr)) - 1) ) == ip2long($network))
        {
            return true;
        }

        return false;
    }
}

$cidr = new cidr();
echo "cidr2netmask: 24 " . $cidr->cidr2netmask(24) . "<br />\n";
echo "cidr2network: 24.59.232.254\24 " . $cidr->cidr2network('24.59.232.254',24) . "<br />\n";
echo "netmask2cidr: 255.255.255.0 " . $cidr->netmask2cidr('255.255.255.0') . "<br />\n";
echo "cidr_match: 10.0.0.1 " . $cidr->cidr_match('10.0.0.1','10.0.0.0','20') . "<br />\n";

$range = "8.8.8.0/24";
$addresses = array();

@list($ip, $len) = explode('/', $range);

if (($min = ip2long($ip)) !== false) {
    $max = ($min | (1<<(32-$len))-1);
    for ($i = $min; $i < $max; $i++)
        $addresses[] = long2ip($i);
}

var_dump($addresses);

/*
$settings = new appSettings();
$settings->setData('name', 'ssh');
$settings->setData('version', '0.12');
$settings->setPorts(22,"open");
echo $settings->getData();
*/