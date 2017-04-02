<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 4:09 AM
 */

include_once 'admin.config.php';

$randip = rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254) . ".";
$ip1 = $randip . "0";
$ip2 = $randip . "254";

$smarty->assign("body", "IP1: $ip1<br />\nIP2: $ip2<br />\n");

$smarty->display('main.tpl');