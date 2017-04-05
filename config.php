<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 3/29/2017
 * Time: 5:40 AM
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);
$base = $_SERVER["DOCUMENT_ROOT"];
session_start();

require 'vendor/autoload.php';

$sql = new sqlManager(getenv('dbHost'), getenv('dbDatabase'), getenv('dbUser'), getenv('dbPass'));
$smarty = new Smarty_HackingSim(true); // set this to true to set smarty debug on
$config = new PHPAuth\Config($sql->getPdo());
$auth = new userManager($sql->getPdo(), $config);

$loggedIN = $auth->isLogged();
$smarty->assign('LogedIn', $loggedIN);
$location = $_SERVER['REQUEST_URI'];
$smarty->assign('location', $location);
$userIP = getIp();
$smarty->assign('userIP', $userIP);

function getIpInfo($ip_addr = "172.14.1.57", $subnet_mask = "255.255.255.0")
{
    $ip = ip2long($ip_addr);
    $nm = ip2long($subnet_mask);
    $nw = ($ip & $nm);
    $bc = $nw | (~$nm);
    $data = '';
    $data .= "IP Address:         " . long2ip($ip) . "\n";
    $data .= "Subnet Mask:        " . long2ip($nm) . "\n";
    $data .= "Network Address:    " . long2ip($nw) . "\n";
    $data .= "Broadcast Address:  " . long2ip($bc) . "\n";
    $data .= "Number of Hosts:    " . ($bc - $nw - 1) . "\n";
    $data .= "Host Range:         " . long2ip($nw + 1) . " -> " . long2ip($bc - 1) . "\n";
    return $data;
}

function find_net($host, $mask)
{
    ### Function to determine network characteristics
    ### $host = IP address or hostname of target host (string)
    ### $mask = Subnet mask of host in dotted decimal (string)
    ### returns array with
    ###   "cidr"      => host and mask in CIDR notation
    ###   "network"   => network address
    ###   "broadcast" => broadcast address
    ###
    ### Example: find_net("192.168.37.215","255.255.255.224")
    ### returns:
    ###    "cidr"      => 192.168.37.215/27
    ###    "network"   => 192.168.37.192
    ###    "broadcast" => 192.168.37.223
    ###

    $bits = strpos(decbin(ip2long($mask)), "0");
    $net["cidr"] = gethostbyname($host) . "/" . $bits;

    $net["network"] = long2ip(bindec(decbin(ip2long(gethostbyname($host))) & decbin(ip2long($mask))));

    $binhost = str_pad(decbin(ip2long(gethostbyname($host))), 32, "0", STR_PAD_LEFT);
    $binmask = str_pad(decbin(ip2long($mask)), 32, "0", STR_PAD_LEFT);
    $broadcast = '';
    for ($i = 0; $i < 32; $i++) {
        if (substr($binhost, $i, 1) == "1" || substr($binmask, $i, 1) == "0") {
            $broadcast .= "1";
        } else {
            $broadcast .= "0";
        }
    }
    $net["broadcast"] = long2ip(bindec($broadcast));

    return $net;
}

function getIp()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}