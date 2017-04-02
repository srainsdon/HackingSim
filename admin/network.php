<?php
/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/2/2017
 * Time: 4:09 AM
 */

// INSERT INTO `HackingSim`.`Networks` (`NetworkStart`, `NetworkEnd`) VALUES ('406579200', '406579454');

include_once 'admin.config.php';

$randip = rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254) . ".";
$ip1 = $randip . "0";
$ip2 = $randip . "254";
$long1 = sprintf('%u', ip2long($ip1));
$long2 = sprintf('%u', ip2long($ip2));

$smarty->assign("bCrumbs", "Network List");
$smarty->assign('networks', $sql->listNets());
$smarty->assign('ips', array('ip1' => $ip1, 'ip2' => $ip2, 'long1' => $long1, 'long2' => $long2));
$smarty->assign("body", "IP1: $ip1 - $long1<br />\nIP2: $ip2 - $long2<br />\n\n"
    . "<pre>INSERT INTO `HackingSim`.`Networks` (`NetworkStart`, `NetworkEnd`, `NetworkName`) VALUES ('$long1', '$long2');</pre>");
$smarty->display('network.tpl');