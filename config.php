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
$smarty = new Smarty_HackingSim(false); // set this to true to set smarty debug on

$config = new PHPAuth\Config($sql->getPdo());
$auth = new PHPAuth\Auth($sql->getPdo(), $config);


if ($auth->isLogged()) {
    $smarty->assign('LogedIn', True);
} else {
    $smarty->assign('LogedIn', False);
}

$location = $_SERVER['REQUEST_URI'];
$smarty->assign('location', $location);
$userIP = getIp();
$smarty->assign('userIP', $userIP);
/*
$smarty->registerPlugin("function", "date_now", "print_current_date");

function print_nav_bar($params, $smarty)
{
    $navMenu = array();
}*/

function getIpInfo()
{
    $ip_addr = "172.14.1.57";
    $subnet_mask = "255.255.255.0";

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

function getIp()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}